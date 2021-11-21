<?php

namespace App\Http\Livewire\GiaoPhan;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AnalyticGiaoPhan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $giao_phan_id,
        $giam_muc,
        $giao_hat_id,
        $sinh_hoac_tu = 1,
        $paginate_number = 20,
        $start_date,
        $static_gp,
        $all_giao_phan,
        $sinh_tu_follow_year,
        $end_date;
    protected $queryString = ['giao_phan_id', 'start_date', 'end_date','sinh_hoac_tu', 'sinh_tu_follow_year'];



    public function mount()
    {
        $this->giao_phan_id = request()->query('giao_phan_id', $this->giao_phan_id);
        $this->start_date = request()->query('start_date', $this->start_date);
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->sinh_tu_follow_year = request()->query('sinh_tu_follow_year', $this->sinh_tu_follow_year);
        $this->sinh_hoac_tu = request()->query('sinh_hoac_tu', $this->sinh_hoac_tu);
        if (!$this->giao_phan_id){
            $this->giao_phan_id = GiaoPhan::find(Auth::user()->giao_phan_id)->id;
        }
        if (!$this->start_date){
            $this->start_date = Carbon::now()->subYear(1)->format('Y-m-d');
        }
        if (!$this->end_date){
            $this->end_date = Carbon::now()->format('Y-m-d');
        }
        $this->sinh_tu_follow_year = 2031;
        $this->all_giao_phan = GiaoPhan::with('giaoTinh')
            ->orderBy('ten_giao_phan', 'DESC')
            ->get();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $this->giam_muc = TuSi::with('tenThanh')->whereHas('chucVu', function ($q){
            $q->where('ten_chuc_vu', 'Giám mục');
        })->where('la_tong_giam_muc', 'T')
            ->where('giao_phan_id',$this->giao_phan_id)
            ->first();

        // get Year in from start date - end Date
        $start = (int)Carbon::parse($this->start_date)->format('Y');
        $end = (int)Carbon::parse($this->end_date)->format('Y');
        $start_end_year = array();
        $key = 0;
        for ($i = $start; $i < $end + 1; $i++){
            $start_end_year[$key] = $start++;
            $key++;
        }

        $analytic_gender = $this->getGenderSinhOrTu($this->sinh_hoac_tu, $this->sinh_tu_follow_year);

        $statistic_tu_si = $this->statisticChuCVu();
        // get Giao Phan
        $statistics_giao_phan =  GiaoPhan::withCount(['tuSi', 'giaoDan', 'hoGiaDinh', 'giaoHat'])
            ->where('id', $this->giao_phan_id)
            ->first();
        $statistic_bi_tich = $this->statisticBiTich();

        // draw chart
        if (!$this->sinh_tu_follow_year){
            $this->sinh_tu_follow_year = $start_end_year[0];
        }
        $this->emit('updateLineChart', json_encode($analytic_gender));
        $this->emit('updatePieChart', json_encode($statistic_tu_si));
        // show GiaoHat to table
        $all_giao_hat = GiaoHat::withCount(['giaoXu', 'giaoDan'])
                        ->with('tuSi', function ($q) {
                            $q->with('tenThanh')
                                ->where('la_tong_giam_muc', 'H')
                                ->first();
                        })
                        ->where('giao_phan_id', $this->giao_phan_id);
        // search GiaoHat By Id
        if ($this->giao_hat_id){
            $all_giao_hat = $all_giao_hat->where('id', $this->giao_hat_id);
        }
        return view('livewire.giao-phan.analytic-giao-phan',
            compact('statistics_giao_phan', 'start_end_year'))
            ->with(['all_giao_phan' => $this->all_giao_phan,
                'giam_muc' => $this->giam_muc,
                'all_giao_hat' => $this->giao_hat_id ? $all_giao_hat : $all_giao_hat->paginate($this->paginate_number),
                'analytics_bi_tich' => $statistic_bi_tich,
                'analytic_gender' => json_encode($analytic_gender),
                'analytic_tu_si' => json_encode($statistic_tu_si)]);
    }

    public function  getGenderSinhOrTu($id, $year){
        $get_current_year = $year;
        $gender_all_giao_phan =  DB::table('giao_phan as gp')
            ->join('giao_hat as gh', 'gh.giao_phan_id', '=', 'gp.id')
            ->join('giao_xu as gx', 'gx.giao_hat_id', '=', 'gh.id')
            ->join('so_gia_dinh_cong_giao as sgd', 'sgd.giao_xu_id', '=', 'gx.id')
            ->join('thanh_vien as tv', 'tv.so_gia_dinh_id', '=', 'sgd.id')
            ->where('gp.id', $this->giao_phan_id);

        if ($id == 1){
            $gender_all_giao_phan = $gender_all_giao_phan->select(
                DB::raw('count(IF(gioi_tinh = 1,1,NULL)) as males'),
                DB::raw('count(IF(gioi_tinh = 0,1,NULL)) as females'),
                DB::raw('MONTH(ngay_sinh) as ThangSinh')
            )
                ->orderBy(DB::raw("MONTH(ngay_sinh)"))
                ->groupBy('ngay_sinh')
                ->havingRaw('YEAR(ngay_sinh) ='. $get_current_year)
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


    public function statisticChuCVu(){
        $all_chuc_vu = DB::table('chuc_vu as cv')
            ->join('tu_si as ts', 'ts.chuc_vu_id', '=', 'cv.id')
            ->join('giao_phan as gp', 'gp.id', '=', 'ts.giao_phan_id')
            ->select(
                DB::raw('COUNT(DISTINCT(ts.id)) as tu_si_count'),
                'cv.ten_chuc_vu')
            ->groupBy('cv.ten_chuc_vu')
            ->where('gp.id', $this->giao_phan_id)
            ->get();
        $analytic_tu_si = [];
        foreach($all_chuc_vu as $cv)
        {
            $analytic_tu_si[$cv->ten_chuc_vu] = $cv->tu_si_count;
        }
        return $analytic_tu_si;
    }

    public function statisticBiTich(){
        $bi_tich_query_set = DB::table('giao_phan as gp')
            ->join('giao_hat as gh', 'gh.giao_phan_id', '=', 'gp.id')
            ->join('giao_xu as gx', 'gx.giao_hat_id', '=', 'gh.id')
            ->join('so_gia_dinh_cong_giao as sgd', 'sgd.giao_xu_id', '=', 'gx.id')
            ->join('thanh_vien as tv', 'tv.so_gia_dinh_id', '=','sgd.id')
            ->join('bi_tich_da_nhan as btdn', 'btdn.thanh_vien_id', '=', 'tv.id')
            ->join('bi_tich as bt', 'bt.id', '=', 'btdn.bi_tich_id')
            ->where('gp.id', $this->giao_phan_id)
            ->select(DB::raw('COUNT(btdn.id) as thanh_vien_count'),
                'bt.ten_bi_tich as ten_bi_tich')
            ->groupBy('ten_bi_tich', 'gp.id')
            ->get();

        $analytics_bi_tich = [];
        foreach ($bi_tich_query_set as $bt){
            if ($bt->ten_bi_tich == 'Rửa tội') $analytics_bi_tich['rua_toi'] = $bt->thanh_vien_count;
            if ($bt->ten_bi_tich == 'Xưng tội') $analytics_bi_tich['xung_toi'] = $bt->thanh_vien_count;
            if ($bt->ten_bi_tich == 'Thêm sức') $analytics_bi_tich['them_suc'] = $bt->thanh_vien_count;
            if ($bt->ten_bi_tich == 'Hôn phối') $analytics_bi_tich['hon_phoi'] = $bt->thanh_vien_count;
        }

        $analytics_bi_tich['rua_toi']  = array_key_exists('rua_toi', $analytics_bi_tich) ? $analytics_bi_tich['rua_toi'] : 0;
        $analytics_bi_tich['xung_toi'] =array_key_exists('xung_toi', $analytics_bi_tich) ? $analytics_bi_tich['xung_toi'] : 0;
        $analytics_bi_tich['them_suc'] = array_key_exists('them_suc', $analytics_bi_tich) ? $analytics_bi_tich['them_suc'] : 0;
        $analytics_bi_tich['hon_phoi'] = array_key_exists('hon_phoi', $analytics_bi_tich) ? $analytics_bi_tich['hon_phoi'] : 0;

        return $analytics_bi_tich;
    }
}
