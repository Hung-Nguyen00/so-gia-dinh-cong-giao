<?php

namespace App\Http\Livewire\GiaoTinh;

use App\Models\BiTich;
use App\Models\ChucVu;
use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
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
        $statistics_giao_phan = GiaoPhan::withCount(['giaoXu', 'tuSi', 'giaoDan']);

        return view('livewire.giao-tinh.statistic-all-giao-tinh',compact('start_end_year'))
            ->with([
                'analytic_tu_si' => json_encode($this->statistic_tu_si),
                'statistics_giao_phan' => $statistics_giao_phan->paginate($this->paginate_number),
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
        $static_giao_tinh = GiaoPhan::withCount(['giaoXu', 'tuSi', 'giaoDan']);
        $this->count['giao_phan_count'] = $static_giao_tinh->count();
        $this->count['giao_xu_count'] = 0;
        $this->count['giao_dan_count'] = 0;
        $this->count['tu_si_count'] = 0;
        foreach($static_giao_tinh->get() as $gt){
            $this->count['giao_xu_count'] += $gt->giao_xu_count;
            $this->count['giao_dan_count'] += $gt->giao_dan_count;
            $this->count['tu_si_count'] += $gt->tu_si_count;
        }
    }

    public function statisticChuCVu(){
        $all_chuc_vu = ChucVu::withCount('tuSi')->get();
        $analytic_tu_si = [];
        foreach($all_chuc_vu as $cv)
        {
            $analytic_tu_si[$cv->ten_chuc_vu] = $cv->tu_si_count;
        }
        return $analytic_tu_si;
    }

    public function statisticBiTich(){
        $bi_tich_query_set = BiTich::withCount('thanhVien')->get();
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
