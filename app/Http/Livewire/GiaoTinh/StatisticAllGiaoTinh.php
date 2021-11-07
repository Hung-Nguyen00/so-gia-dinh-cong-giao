<?php

namespace App\Http\Livewire\GiaoTinh;

use App\Models\BiTich;
use App\Models\ChucVu;
use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use function Livewire\str;
use Livewire\WithPagination;

class StatisticAllGiaoTinh extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate_number = 20,
        $giao_hat_id,
        $sinh_hoac_tu = 1,
        $start_date,
        $giao_phan_id,
        $count = array('giao_phan_count' => 0, 'giao_xu_count' => 0, 'giao_dan_count' => 0, 'tu_si_count' => 0),
        $sinh_tu_follow_year,
        $all_chuc_vu,
        $statistic_tu_si,
        $statistic_bi_tich,
        $end_date;

    protected $queryString = ['start_date', 'end_date','sinh_hoac_tu', 'sinh_tu_follow_year', 'giao_phan_id'];

    public function mount()
    {
        $this->start_date = request()->query('start_date', $this->start_date);
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->sinh_tu_follow_year = request()->query('sinh_tu_follow_year', $this->sinh_tu_follow_year);
        $this->sinh_hoac_tu = request()->query('sinh_hoac_tu', $this->sinh_hoac_tu);
        $this->giao_phan_id = request()->query('giao_phan_id', $this->giao_phan_id);
        if (!$this->start_date){
            $this->start_date = Carbon::now()->subYear(10)->format('Y-m-d');
        }
        if (!$this->end_date){
            $this->end_date = Carbon::now()->format('Y-m-d');
        }
        $this->statisticGiaoPhan();
        $this->statistic_tu_si = $this->statisticChuCVu();
        $this->statistic_bi_tich = $this->statisticBiTich();
    }
    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');

        // get Year in from start date - end Date
        $start = (int)Carbon::parse($this->start_date)->format('Y');
        $end = (int)Carbon::parse($this->end_date)->format('Y');
        $start_end_year = array();
        $key = 0;
        for ($i = $start; $i < $end + 1; $i++){
            $start_end_year[$key] = $start++;
            $key++;
        }
        // draw chart
        if (!$this->sinh_tu_follow_year){
            $this->sinh_tu_follow_year = $start_end_year[0];
        }
        #statistic Gender
        $getGender = $this->getGenderSinhOrTu($this->sinh_hoac_tu, $this->sinh_tu_follow_year);

        #render data to Chart
        $this->emit('updateLineChart', json_encode($getGender));
        $this->emit('updatePieChart', json_encode($this->statistic_tu_si));
        #get statistic giao phan
        $statistics_giao_phan = Cache::get('statistic_giao_tinh');
        if ($this->giao_phan_id){
            $statistics_giao_phan = $statistics_giao_phan->where('id',$this->giao_phan_id);
        }

        return view('livewire.giao-tinh.statistic-all-giao-tinh',compact('start_end_year'))
            ->with([
                'analytic_tu_si' => json_encode($this->statistic_tu_si),
                'statistics_giao_phan' => $statistics_giao_phan,
                'all_giao_phan' => GiaoPhan::select('id', 'ten_giao_phan')->get(),
                'count' => $this->count,
                'statistic_bi_tich' => $this->statistic_bi_tich,
                'analytic_gender' => json_encode($getGender)]
            );
    }

    public function  getGenderSinhOrTu($id, $year){
        $get_current_year = $year;
        $gender_all_giao_phan = DB::table('thanh_vien');
        if ($id == 1){
            $gender_all_giao_phan = $gender_all_giao_phan->select(
                DB::raw('count(IF(gioi_tinh = 1,1,NULL)) as males'),
                DB::raw('count(IF(gioi_tinh = 0,1,NULL)) as females'),
                DB::raw('MONTH(ngay_sinh) as ThangSinh')
            )
                ->orderBy(DB::raw("MONTH(ngay_sinh)"))
                ->groupBy('ngay_sinh')
                ->havingRaw('YEAR(ngay_sinh) ='. $year)
                ->get();
        }else{
            $gender_all_giao_phan = $gender_all_giao_phan->select(
                DB::raw('count(IF(gioi_tinh = 1,1,NULL)) as males'),
                DB::raw('count(IF(gioi_tinh = 0,1,NULL)) as females'),
                DB::raw('MONTH(ngay_mat) as ThangSinh')
            )
                ->orderBy(DB::raw("MONTH(ngay_mat)"))
                ->groupBy('ngay_mat')
                ->havingRaw('YEAR(ngay_mat) ='. $get_current_year)
                ->get();
        }

        $res['month'] = ['Tháng 1',
            'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        foreach ($res['month'] as $key=> $value){
            $count = 0 ;
            foreach ($gender_all_giao_phan as $keyI => $val) {
                if ('Tháng '.$val->ThangSinh == $value){
                    $res['males'][$key] = (int)$val->males;
                    $res['females'][$key] = (int)$val->females;
                    $count++;
                }
            }
            if ($count == 0){
                $res['males'][$key] = 0;
                $res['females'][$key] = 0;
            }
        }
        return $res;
    }

    public function statisticGiaoPhan(){
        $static_giao_tinh = DB::table('giao_phan as gp')
            ->leftJoin('tu_si as ts', 'ts.giao_phan_id', '=', 'gp.id')
            ->leftJoin('giao_hat as gh', 'gh.giao_phan_id', '=', 'gp.id')
            ->leftJoin('giao_xu as gx', 'gx.giao_hat_id', '=', 'gh.id')
            ->leftJoin('so_gia_dinh_cong_giao as sgd', 'sgd.giao_xu_id', '=', 'gx.id')
            ->leftJoin('thanh_vien as tv', 'tv.so_gia_dinh_id', '=', 'sgd.id')
            ->select(
                DB::raw('COUNT(DISTINCT(tv.id)) as giao_dan_count'),
                DB::raw('COUNT(DISTINCT(gp.id)) as giao_phan_count'),
                DB::raw('COUNT(DISTINCT(sgd.id)) as sgd_count'),
                DB::raw('COUNT(DISTINCT(gh.id)) as giao_hat_count'),
                DB::raw('COUNT(DISTINCT(sgd.id)) as ho_va_dinh_count'),
                DB::raw('COUNT(DISTINCT(ts.id)) as tu_si_count'),
                DB::raw('COUNT(DISTINCT(gx.id)) as giao_xu_count'),
                'gp.id',
                'gp.dia_chi',
                'gp.ten_nha_tho',
                'gp.ngay_thanh_lap',
                'gp.ten_giao_phan'
            )->groupBy('gp.ten_giao_phan', 'ngay_thanh_lap', 'ten_nha_tho', 'gp.id', 'gp.dia_chi', 'gp.ten_giao_phan')->get();
        if (!Cache::has('statistic_giao_tinh')){
            Cache::put('statistic_giao_tinh', $static_giao_tinh);
        }
        $this->count['giao_phan_count'] = 0;
        $this->count['giao_xu_count'] = 0;
        $this->count['giao_dan_count'] = 0;
        $this->count['tu_si_count'] = 0;
        foreach($static_giao_tinh as $gt){
            $this->count['giao_phan_count'] += $gt->giao_phan_count;
            $this->count['giao_xu_count'] += $gt->giao_xu_count;
            $this->count['giao_dan_count'] += $gt->giao_dan_count;
            $this->count['tu_si_count'] += $gt->tu_si_count;
        }

    }

    public function statisticChuCVu(){
        $all_chuc_vu = DB::table('chuc_vu as cv')
                        ->leftJoin('tu_si as ts', 'ts.chuc_vu_id', '=', 'cv.id')
                        ->select(
                            DB::raw('COUNT(DISTINCT(ts.id)) as tu_si_count'),
                            'cv.ten_chuc_vu')
                        ->groupBy('cv.ten_chuc_vu')
                        ->get();
        $analytic_tu_si = [];
        foreach($all_chuc_vu as $cv)
        {
            $analytic_tu_si[$cv->ten_chuc_vu] = $cv->tu_si_count;
        }
        return $analytic_tu_si;
    }

    public function statisticBiTich(){
        $bi_tich_query_set = DB::table('bi_tich as bt')
                        ->leftJoin('bi_tich_da_nhan as btdn', 'btdn.bi_tich_id', '=', 'bt.id')
                        ->leftJoin('thanh_vien as tv', 'tv.id', '=','btdn.thanh_vien_id')
                        ->select(DB::raw('COUNT(btdn.id) as thanh_vien_count'),
                                'bt.ten_bi_tich as ten_bi_tich')
                        ->groupBy('ten_bi_tich')
                        ->get();
        $analytics_bi_tich = [];
        foreach ($bi_tich_query_set as $bt){
            if ($bt->ten_bi_tich == 'Rửa tội') $analytics_bi_tich['rua_toi'] = $bt->thanh_vien_count;
            if ($bt->ten_bi_tich == 'Xưng tội') $analytics_bi_tich['xung_toi'] = $bt->thanh_vien_count;
            if ($bt->ten_bi_tich == 'Thêm sức') $analytics_bi_tich['them_suc'] = $bt->thanh_vien_count;
            if ($bt->ten_bi_tich == 'Hôn phối') $analytics_bi_tich['hon_phoi'] = $bt->thanh_vien_count;
        }
        return $analytics_bi_tich;
    }
}
