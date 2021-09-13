<?php

namespace App\Http\Livewire\GiaoTinh;

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

    public $paginate_number = 5,
        $giao_hat_id,
        $sinh_hoac_tu = 1,
        $start_date,
        $sinh_tu_follow_year,
        $end_date;

    protected $queryString = ['start_date', 'end_date','sinh_hoac_tu', 'sinh_tu_follow_year'];

    public function mount()
    {
        $this->start_date = request()->query('start_date', $this->start_date);
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->sinh_tu_follow_year = request()->query('sinh_tu_follow_year', $this->sinh_tu_follow_year);
        $this->sinh_hoac_tu = request()->query('sinh_hoac_tu', $this->sinh_hoac_tu);
        if (!$this->start_date){
            $this->start_date = Carbon::now()->subYear(1)->format('Y-m-d');
        }
        if (!$this->end_date){
            $this->end_date = Carbon::now()->format('Y-m-d');
        }
    }
    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        // statistics_all 'giaoPhan','giaoXu','giaoDan', 'tuSi'.
        $statistics_all = GiaoTinh::withCount(['giaoPhan','giaoXu','giaoDan', 'tuSi'])->get();
        $count = array('giao_phan_count' => 0, 'giao_xu_count' => 0, 'giao_dan_count' => 0, 'tu_si_count' => 0);
        foreach($statistics_all as $gp){
            $count['giao_phan_count'] += $gp->giao_phan_count;
            $count['giao_xu_count'] += $gp->giao_xu_count;
            $count['giao_dan_count'] += $gp->giao_dan_count;
            $count['tu_si_count'] += $gp->tu_si_count;
        }
        // show table for each GiaoPhan
        $statistics_giao_phan = GiaoPhan::withCount(['giaoXu', 'giaoHat','giaoDan', 'tuSi']);

        // get Year in from start date - end Date
        $start = (int)Carbon::parse($this->start_date)->format('Y');
        $end = (int)Carbon::parse($this->end_date)->format('Y');
        $start_end_year = array();
        $key = 0;
        for ($i = $start; $i < $end + 1; $i++){
            $start_end_year[$key] = $start++;
            $key++;
        }
        // get BiTich
        $analytics_bi_tich = $this->getBiTich();

        // draw chart
        if (!$this->sinh_tu_follow_year){
            $this->sinh_tu_follow_year = $start_end_year[0];
        }
        $getGender = $this->getGenderSinhOrTu($this->sinh_hoac_tu, $this->sinh_tu_follow_year);
        $analytic_tu_si = $this->getTuSi();
        $this->emit('updateLineChart', json_encode($getGender));
        $this->emit('updatePieChart', json_encode($analytic_tu_si));


        return view('livewire.giao-tinh.statistic-all-giao-tinh',compact(
        'count', 'analytics_bi_tich', 'start_end_year'))
            ->with(['analytic_tu_si' => json_encode($analytic_tu_si),
                'statistics_giao_phan' => $statistics_giao_phan->paginate($this->paginate_number),
                'analytic_gender' => json_encode($getGender)]);
    }

    public function getTuSi(){
        // analytics TUSI
        $count_ts= DB::table('giao_tinh as gt')
            ->leftJoin('giao_phan as p', 'gt.id', '=', 'p.giao_tinh_id')
            ->leftJoin('tu_si as ts', 'ts.giao_phan_id', '=', 'p.id')
            ->leftJoin('chuc_vu as c', 'c.id', '=', 'ts.chuc_vu_id')
            ->select( DB::raw('count(ts.id) as TuSi'), 'c.ten_chuc_vu as chuc_vu', 'ngay_nhan_chuc')
            ->whereBetween('ngay_nhan_chuc', [$this->start_date, $this->end_date])
            ->groupBy('gt.id', 'chuc_vu', 'ngay_nhan_chuc')
            ->simplePaginate();

        $count_giam_muc = $count_ts->where('chuc_vu', 'Giám mục')->sum('TuSi');
        $count_linh_muc = $count_ts->where('chuc_vu', 'Linh mục')->sum('TuSi');
        $count_chung_sinh = $count_ts->where('chuc_vu', 'Chủng sinh')->sum('TuSi');
        $count_so = $count_ts->where('chuc_vu', 'Sơ')->sum('TuSi');
        $analytic_tu_si = ['Giám mục' => $count_giam_muc,
            'Linh mục' => $count_linh_muc,
            'Chủng sinh' => $count_chung_sinh,
            'Sơ' => $count_so];

        return $analytic_tu_si;
    }

    public function getBiTich(){
        $count_rua_toi  = 0;
        $count_xung_toi = 0;
        $count_them_suc = 0;
        $count_hon_phoi = 0;

        DB::table('giao_tinh as gt')
            ->join('giao_phan as p', 'gt.id', '=', 'p.giao_tinh_id')
            ->join('giao_hat as h', 'p.id', '=', 'h.giao_phan_id')
            ->join('giao_xu as x', 'h.id', '=', 'x.giao_hat_id')
            ->join('so_gia_dinh_cong_giao as sgdcg', 'x.id', '=', 'sgdcg.giao_xu_id')
            ->join('thanh_vien as tv', 'sgdcg.id', '=', 'tv.so_gia_dinh_id')
            ->join('bi_tich_da_nhan as btdn', 'tv.id', '=', 'btdn.thanh_vien_id')
            ->join('bi_tich as bt', 'bt.id', '=', 'btdn.bi_tich_id')
            ->orderBy('btdn.created_at', 'DESC')
            ->select('tv.id as ThanhVien', 'bt.ten_bi_tich as BiTich', 'btdn.ngay_dien_ra')
            ->whereBetween('ngay_dien_ra', [$this->start_date, $this->end_date])
            ->chunk(1000, function ($value) use(&$count_rua_toi, &$count_xung_toi, &$count_them_suc, &$count_hon_phoi){
                $count_rua_toi += $value->where('BiTich', 'Rửa tội')->count();
                $count_them_suc += $value->where('BiTich', 'Thêm sức')->count();
                $count_hon_phoi += $value->where('BiTich', 'Hôn phối')->count();
                $count_xung_toi += $value->where('BiTich', 'Xưng tội')->count();
            });
        $analytics_bi_tich = ['rua_toi' => $count_rua_toi,
            'them_suc' => $count_them_suc,
            'hon_phoi' => $count_them_suc,
            'xung_toi' => $count_xung_toi];

        return $analytics_bi_tich;
    }
    public function  getGenderSinhOrTu($id, $year){
        $get_current_year = $year;
        $gender_all_giao_phan = DB::table('giao_tinh as gt')
            ->leftJoin('giao_phan as p', 'gt.id', '=', 'p.giao_tinh_id')
            ->leftJoin('giao_hat as h', 'p.id', '=', 'h.giao_phan_id')
            ->leftJoin('giao_xu as x', 'h.id', '=', 'x.giao_hat_id')
            ->leftJoin('so_gia_dinh_cong_giao as sgd', 'x.id', '=', 'sgd.giao_xu_id')
            ->leftJoin('thanh_vien as tv', 'sgd.id', '=', 'tv.so_gia_dinh_id')
            ;
        if ($id == 1){
            $gender_all_giao_phan = $gender_all_giao_phan->select(
                DB::raw('count(IF(tv.gioi_tinh = 1,1,NULL)) as males'),
                DB::raw('count(IF(tv.gioi_tinh = 0,1,NULL)) as females'),
                DB::raw('MONTH(tv.ngay_sinh) as ThangSinh')
            )
                ->orderBy(DB::raw("MONTH(tv.ngay_sinh)"))
                ->groupBy('tv.ngay_sinh')
                ->havingRaw('YEAR(tv.ngay_sinh) ='. $year)
                ->get();
        }else{
            $gender_all_giao_phan = $gender_all_giao_phan->select(
                DB::raw('count(IF(tv.gioi_tinh = 1,1,NULL)) as males'),
                DB::raw('count(IF(tv.gioi_tinh = 0,1,NULL)) as females'),
                DB::raw('MONTH(tv.ngay_mat) as ThangSinh')
            )
                ->orderBy(DB::raw("MONTH(tv.ngay_mat)"))
                ->groupBy('tv.ngay_mat')
                ->havingRaw('YEAR(tv.ngay_mat) ='. $get_current_year)
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
}
