<?php

namespace App\Http\Livewire\GiaoPhan;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AnalyticGiaoPhan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $giao_phan_id,
        $giam_muc,
        $paginate_number = 5,
        $giao_hat_id,
        $sinh_hoac_tu = 1,
        $start_date,
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
            $this->giao_phan_id = GiaoPhan::find(Auth::user()->giao_xu_id)->id;
        }
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

        // get Giao Phan
        $statistics_giao_phan = GiaoPhan::select('id', 'dia_chi', 'ten_nha_tho')
            ->with('giaoHat')
            ->withCount(['giaoXu', 'giaoHat', 'tuSi'])
            ->where('id', $this->giao_phan_id)
            ->first();
        // draw chart
        if (!$this->sinh_tu_follow_year){
            $this->sinh_tu_follow_year = $start_end_year[0];
        }
        $analytic_gender = $this->getGender($this->sinh_hoac_tu, $this->sinh_tu_follow_year);
        $analytic_tu_si = $this->getTuSi();
        $this->emit('updateLineChart', json_encode($analytic_gender));
        $this->emit('updatePieChart', json_encode($analytic_tu_si));
        // show Statistic BiTich to Card
        $analytics_bi_tich = $this->analyticBiTich();

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
            $all_giao_hat = $all_giao_hat->where('id', $this->giao_hat_id)->get();
        }
        // all giao phan
        $all_giao_phan = GiaoPhan::with('giaoTinh')
            ->orderBy('ten_giao_phan', 'DESC')
            ->get();
        return view('livewire.giao-phan.analytic-giao-phan',
            compact('statistics_giao_phan', 'analytics_bi_tich', 'start_end_year'))
            ->with(['all_giao_phan' => $all_giao_phan,
                'giam_muc' => $this->giam_muc,
                'all_giao_hat' => $this->giao_hat_id ? $all_giao_hat : $all_giao_hat->paginate($this->paginate_number),
                'analytic_gender' => json_encode($analytic_gender),
                'analytic_tu_si' => json_encode($analytic_tu_si)]);
    }



    // get gender to Chart
    public function getGender($id, $year){
        $get_current_year = $year;
        $gender_all_giao_phan = DB::table('giao_phan as p')
            ->leftJoin('giao_hat as h', 'p.id', '=', 'h.giao_phan_id')
            ->leftJoin('giao_xu as x', 'h.id', '=', 'x.giao_hat_id')
            ->leftJoin('so_gia_dinh_cong_giao as sgd', 'x.id', '=', 'sgd.giao_xu_id')
            ->leftJoin('thanh_vien as tv', 'sgd.id', '=', 'tv.so_gia_dinh_id')
            ->where('p.id', $this->giao_phan_id);
        if ($id == 1){
            $gender_all_giao_phan = $gender_all_giao_phan->select(
                DB::raw('count(IF(tv.gioi_tinh = 1,1,NULL)) as males'),
                DB::raw('count(IF(tv.gioi_tinh = 0,1,NULL)) as females'),
                DB::raw('MONTH(tv.ngay_sinh) as ThangSinh')
            )
                ->orderBy(DB::raw("MONTH(tv.ngay_sinh)"))
                ->groupBy('tv.ngay_sinh')
                ->havingRaw('YEAR(tv.ngay_sinh) ='. $get_current_year)
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

    public function getTuSi(){
        $count_ts= DB::table('giao_phan as p')
            ->leftJoin('tu_si as ts', 'ts.giao_phan_id', '=', 'p.id')
            ->leftJoin('chuc_vu as c', 'c.id', '=', 'ts.chuc_vu_id')
            ->select( DB::raw('count(ts.id) as TuSi'), 'c.ten_chuc_vu as chuc_vu', 'ngay_nhan_chuc')
            ->groupBy( 'chuc_vu', 'ngay_nhan_chuc')
            ->whereBetween('ngay_nhan_chuc', [$this->start_date, $this->end_date])
            ->where('p.id', $this->giao_phan_id)
            ->get();
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

    public function analyticBiTich(){
        $count_rua_toi  = 0;
        $count_xung_toi = 0;
        $count_them_suc = 0;
        $count_hon_phoi = 0;
        $count_sgd = 0;
        $count_tv = 0;
         DB::table('giao_phan as p')
            ->join('giao_hat as h', 'p.id', '=', 'h.giao_phan_id')
            ->join('giao_xu as x', 'h.id', '=', 'x.giao_hat_id')
            ->join('so_gia_dinh_cong_giao as sgdcg', 'x.id', '=', 'sgdcg.giao_xu_id')
            ->join('thanh_vien as tv', 'sgdcg.id', '=', 'tv.so_gia_dinh_id')
            ->leftJoin('bi_tich_da_nhan as btdn', 'tv.id', '=', 'btdn.thanh_vien_id')
            ->leftJoin('bi_tich as bt', 'bt.id', '=', 'btdn.bi_tich_id')
            ->where('p.id', $this->giao_phan_id)
            ->whereBetween('ngay_dien_ra', [$this->start_date, $this->end_date])
            ->orderBy('btdn.created_at', 'DESC')
            ->select('tv.id as ThanhVien', 'bt.ten_bi_tich as BiTich','btdn.ngay_dien_ra', 'sgdcg.id as sgd')
            ->chunk(1000, function ($value)
            use(&$count_rua_toi, &$count_xung_toi, &$count_them_suc, &$count_hon_phoi, &$count_tv, &$count_sgd){
                $count_rua_toi += $value->where('BiTich', 'Rửa tội')->count();
                $count_them_suc += $value->where('BiTich', 'Thêm sức')->count();
                $count_hon_phoi += $value->where('BiTich', 'Hôn phối')->count();
                $count_xung_toi += $value->where('BiTich', 'Xưng tội')->count();
                $count_sgd  += $value->whereNotNull('sgd')->groupBy('sgd')->count();
                $count_tv += $value->whereNotNull('ThanhVien')->groupBy('ThanhVien')->count();
            });
        $analytics_bi_tich = ['rua_toi' => $count_rua_toi,
            'xung_toi' => $count_xung_toi,
            'them_suc' => $count_them_suc,
            'hon_phoi' => $count_them_suc];

        $count_tv_sgd = ['count_tv' => $count_tv, 'count_sgd' => $count_sgd];

        return array_merge($analytics_bi_tich, $count_tv_sgd);
    }
}
