<?php

namespace App\Http\Livewire\GiaoXu;

use App\Models\GiaoXu;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StatictisGiaoXu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $giao_xu_id = 1,
        $linh_muc_chanh_xu,
        $paginate_number = 5,
        $giao_ho_id,
        $start_date,
        $end_date,
        $sinh_tu_follow_year,
        $sinh_hoac_tu = 1;
    protected $queryString = ['giao_xu_id','sinh_hoac_tu', 'start_date', 'end_date', 'sinh_tu_follow_year'];



    public function mount()
    {
        $this->giao_xu_id = request()->query('giao_xu_id', $this->giao_xu_id);
        $this->sinh_hoac_tu = request()->query('sinh_hoac_tu', $this->sinh_hoac_tu);
        $this->start_date = request()->query('start_date', $this->start_date);
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->sinh_tu_follow_year = request()->query('sinh_tu_follow_year', $this->sinh_tu_follow_year);
        $this->linh_muc_chanh_xu = TuSi::with('tenThanh')->whereHas('viTri', function ($q){
            $q->where('ten_vi_tri', 'Cha xứ');
        })->where('giao_xu_id',$this->giao_xu_id)
            ->first();
        if (!$this->linh_muc_chanh_xu){
            Toastr::warning('Không có dữ liệu', 'Cảnh báo');
            return redirect()->route('home');
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
        $this->dispatchBrowserEvent('Changed');
        // get Year in from start date - end Date
        $start = (int)Carbon::parse($this->start_date)->format('Y');
        $end = (int)Carbon::parse($this->end_date)->format('Y');
        $start_end_year = array();
        $key = 0;
        for ($i = $start; $i < $end + 1; $i++){
            $start_end_year[$key] = $start++;
            $key++;
        }
        $statistics_giao_xu = GiaoXu::withCount(['giaoHo','giaoDan', 'tuSi', 'hoGiaDinh'])
            ->where('id', $this->giao_xu_id)
            ->first();
        // all giao xu
        $all_giao_xu = GiaoXu::with('giaoHat')
            ->where('giao_xu_hoac_giao_ho', 0)
            ->get();
            
        // draw chart
        if (!$this->sinh_tu_follow_year){
            $this->sinh_tu_follow_year = $start_end_year[0];
        }
        $analytic_gender = $this->getGender($this->sinh_hoac_tu, $this->sinh_tu_follow_year);
        $analytics_bi_tich = $this->analyticBiTich();
        $this->emit('updateLineChart', json_encode($analytic_gender));
        $this->emit('updatePieChart', json_encode($analytics_bi_tich));
        // search GiaoHat By Id
        return view('livewire.giao-xu.statictis-giao-xu',
            compact('statistics_giao_xu', 'analytics_bi_tich', 'start_end_year', 'all_giao_xu'))
            ->with(['giam_muc' => $this->linh_muc_chanh_xu,
                'analytic_gender' => json_encode($analytic_gender),
                'analytics_bi_tich' => json_encode($analytics_bi_tich)]);
    }
    // get gender to Chart
    public function getGender($id, $year){
        $get_current_year = $year;
        // prepare query
        $gender_all_giao_xu = DB::table('giao_xu as x')
            ->leftJoin('so_gia_dinh_cong_giao as sgd', 'x.id', '=', 'sgd.giao_xu_id')
            ->leftJoin('thanh_vien as tv', 'sgd.id', '=', 'tv.so_gia_dinh_id')
            ->where('x.id', $this->giao_xu_id);
        // 1 == sinh, else = tử
        if ($id == 1){
            $gender_all_giao_xu = $gender_all_giao_xu->select(
                DB::raw('count(IF(tv.gioi_tinh = 1,1,NULL)) as males'),
                DB::raw('count(IF(tv.gioi_tinh = 0,1,NULL)) as females'),
                DB::raw('MONTH(tv.ngay_sinh) as ThangSinh')
            )
                ->orderBy(DB::raw("MONTH(tv.ngay_sinh)"))
                ->groupBy('tv.ngay_sinh')
                ->havingRaw('YEAR(tv.ngay_sinh) ='. $get_current_year)
                ->get();
        }else{
            $gender_all_giao_xu = $gender_all_giao_xu->select(
                DB::raw('count(IF(tv.gioi_tinh = 1,1,NULL)) as males'),
                DB::raw('count(IF(tv.gioi_tinh = 0,1,NULL)) as females'),
                DB::raw('MONTH(tv.ngay_mat) as ThangSinh')
            )
                ->orderBy(DB::raw("MONTH(tv.ngay_mat)"))
                ->groupBy('tv.ngay_mat')
                ->havingRaw('YEAR(tv.ngay_mat) ='. $get_current_year)
                ->get();
        }
        // create 12 months to show on Line Chart
        $res['month'] = ['Tháng 1',
            'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        // If above query don't have value on $res's months, it will be 0
        foreach ($res['month'] as $key=> $value){
            $count = 0 ;
            foreach ($gender_all_giao_xu as $keyI => $val) {
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

    public function analyticBiTich(){
        $count_rua_toi  = 0;
        $count_xung_toi = 0;
        $count_them_suc = 0;
        $count_hon_phoi = 0;

        DB::table('giao_xu as x')
            ->join('so_gia_dinh_cong_giao as sgdcg', 'x.id', '=', 'sgdcg.giao_xu_id')
            ->join('thanh_vien as tv', 'sgdcg.id', '=', 'tv.so_gia_dinh_id')
            ->join('bi_tich_da_nhan as btdn', 'tv.id', '=', 'btdn.thanh_vien_id')
            ->join('bi_tich as bt', 'bt.id', '=', 'btdn.bi_tich_id')
            ->where('x.id', $this->giao_xu_id)
            ->whereBetween('ngay_dien_ra', [$this->start_date, $this->end_date])
            ->orderBy('btdn.created_at', 'DESC')
            ->select('tv.id as ThanhVien', 'btdn.ngay_dien_ra', 'bt.ten_bi_tich as BiTich')
            ->chunk(1000, function ($value) use(&$count_rua_toi, &$count_xung_toi, &$count_them_suc, &$count_hon_phoi){
                $count_rua_toi += $value->where('BiTich', 'Rửa tội')->count();
                $count_them_suc += $value->where('BiTich', 'Thêm sức')->count();
                $count_hon_phoi += $value->where('BiTich', 'Hôn phối')->count();
                $count_xung_toi += $value->where('BiTich', 'Xưng tội')->count();
            });
        // add result from above query to array. It's will be access, and also pass it
        $analytics_bi_tich = ['Rửa tội' => $count_rua_toi,
            'Xưng tội' => $count_xung_toi,
            'Thêm sức' => $count_them_suc,
            'Hôn phối' => $count_them_suc,];

        return $analytics_bi_tich;
    }

}
