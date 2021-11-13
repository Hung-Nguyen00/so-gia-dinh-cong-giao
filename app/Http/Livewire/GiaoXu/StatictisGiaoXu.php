<?php

namespace App\Http\Livewire\GiaoXu;

use App\Models\GiaoXu;
use App\Models\LichSuSgdcg;
use App\Models\SoGiaDinh;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StatictisGiaoXu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $giao_xu_id,
        $linh_muc_chanh_xu,
        $paginate_number = 5,
        $giao_ho_id,
        $start_date,
        $end_date,
        $sinh_tu_follow_year,
        $sinh_hoac_tu = 1,
        $statistic_bi_tich,
        $statistic_giao_xu,
        $giao_ho;
    protected $queryString = ['giao_xu_id','sinh_hoac_tu', 'start_date', 'end_date', 'sinh_tu_follow_year'];



    public function mount()
    {
        $this->giao_xu_id = request()->query('giao_xu_id', $this->giao_xu_id);
        $this->sinh_hoac_tu = request()->query('sinh_hoac_tu', $this->sinh_hoac_tu);
        $this->start_date = request()->query('start_date', $this->start_date);
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->sinh_tu_follow_year = request()->query('sinh_tu_follow_year', $this->sinh_tu_follow_year);
        if (!$this->start_date){
            $this->start_date = Carbon::now()->subYear(1)->format('Y-m-d');
        }
        if (!$this->end_date){
            $this->end_date = Carbon::now()->format('Y-m-d');
        }
        if (!$this->giao_xu_id){
            $this->giao_xu_id = GiaoXu::find(Auth::user()->giao_xu_id)->id;
        }
        $this->giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho',$this->giao_xu_id)
            ->orWhere('id',  $this->giao_xu_id)
            ->pluck('id')->toArray();

        $this->statistic_bi_tich = $this->getStaticBiTich();
        $this->statistics_giao_xu = GiaoXu::withCount(['giaoHo','giaoDan', 'tuSi', 'hoGiaDinh'])
            ->where('id', $this->giao_xu_id)
            ->first();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('Changed');
        $statis_bi_tich = $this->statistic_bi_tich->whereBetween('ngay_dien_ra', [$this->start_date, $this->end_date]);
        $analytics_bi_tich = $this->analyticBiTich($statis_bi_tich);
        // get Linh Muc
        $this->linh_muc_chanh_xu = TuSi::with('tenThanh')->whereHas('viTri', function ($q){
            $q->where('ten_vi_tri', 'Cha xứ');
        })->where('giao_xu_id',$this->giao_xu_id)
            ->first();

        // get Year for Form in interface start date - end Date (filter: sinh_hoac_tu)
        $start = (int)Carbon::parse($this->start_date)->format('Y');
        $end = (int)Carbon::parse($this->end_date)->format('Y');
        $start_end_year = array();
        $key = 0;
        for ($i = $start; $i < $end + 1; $i++){
            $start_end_year[$key] = $start++;
            $key++;
        }

       //  statistics GiaoXu
        $statistics_giao_xu = $this->statistics_giao_xu;

        // get all_giao_ho
        $all_giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', $statistics_giao_xu->id)
            ->withCount('giaoDan')
            ->with(['tuSi' => function ($q) {
                    $q->with('tenThanh');
            }])->get();
//        // all giao xu
        $all_giao_xu = GiaoXu::with('giaoHat')
            ->where('giao_xu_hoac_giao_ho', 0)
            ->get();

         // statistic age
        $statistic_age = $this->statisticAge();
        // statistic Chuyen Xu
        $giao_ho = array_values($this->giao_ho);
        // get statistic chuyen_xu and nhap_xu
        $statistic_chuyen_xu = LichSuSgdcg::whereIn('giao_xu_id', $giao_ho)
            ->whereBetween('created_at', [$this->start_date, $this->end_date])
            ->count();

        // count SGDCG by LichSuChuyenXU. It's mean this sgdcg come from other GiaoXu
        // and go to this GiaoXu(giao_xu_id)
        $count_from_other_giao_xu = SoGiaDinh::whereIn('giao_xu_id', $giao_ho)
            ->whereHas('lichSuChuyenXu')
            ->count();
        // count sgdcg when User create new sgdcg and ngay_tao_so is between start_date and end_date
        $count_create_new_sgdcg = SoGiaDinh::whereIn('giao_xu_id', $giao_ho)
            ->where('la_nhap_xu', 1)
            ->whereDoesntHave('lichSuChuyenXu')
            ->whereBetween('ngay_tao_so', [$this->start_date, $this->end_date])
            ->count();

        $statistic_nhap_xu = $count_from_other_giao_xu + $count_create_new_sgdcg;
        // draw chart
        if (!$this->sinh_tu_follow_year){
            $this->sinh_tu_follow_year = $start_end_year[0];
        }
        $analytic_gender = $this->getGender($this->sinh_hoac_tu, $this->sinh_tu_follow_year);
        $this->emit('updateLineChart', json_encode($analytic_gender));
        $this->emit('updatePieChart', json_encode($analytics_bi_tich));

        return view('livewire.giao-xu.statictis-giao-xu',
            compact('statistics_giao_xu',
                'analytics_bi_tich',
                'start_end_year',
                'all_giao_ho',
                'statistic_nhap_xu',
                'all_giao_xu',
                'statistic_age',
                'statistic_chuyen_xu'))
            ->with(['giam_muc' => $this->linh_muc_chanh_xu,
                'analytic_gender' => json_encode($analytic_gender),
                'analytics_bi_tich' => json_encode($analytics_bi_tich)]);
    }


    // get gender to Chart
    public function getGender($id, $year){
        $get_current_year = $year;
        // prepare query
        $gender_all_giao_xu = DB::table('so_gia_dinh_cong_giao as sgd')
            ->leftJoin('thanh_vien as tv', 'sgd.id', '=', 'tv.so_gia_dinh_id')
            ->where('sgd.giao_xu_id', $this->giao_xu_id);
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

    public function getStaticBiTich(){
        $statistic_bi_tich = DB::table('so_gia_dinh_cong_giao as sgdcg')
            ->join('thanh_vien as tv', 'sgdcg.id', '=', 'tv.so_gia_dinh_id')
            ->join('bi_tich_da_nhan as btdn', 'tv.id', '=', 'btdn.thanh_vien_id')
            ->join('bi_tich as bt', 'bt.id', '=', 'btdn.bi_tich_id')
            ->orderBy('btdn.created_at', 'DESC')
            ->select('tv.id as ThanhVien', 'btdn.ngay_dien_ra', 'sgdcg.giao_xu_id','bt.ten_bi_tich as BiTich')
            ->where('sgdcg.giao_xu_id', $this->giao_xu_id)
            ->get();
        return $statistic_bi_tich;
    }

    public function analyticBiTich($statistic_bi_tich){
        // add result from above query to array. It's will be access, and also pass it
        $analytics_bi_tich = ['Rửa tội' => $statistic_bi_tich->where('BiTich', 'Rửa tội')->count(),
            'Xưng tội' => $statistic_bi_tich->where('BiTich', 'Thêm sức')->count(),
            'Thêm sức' => $statistic_bi_tich->where('BiTich', 'Hôn phối')->count(),
            'Hôn phối' => $statistic_bi_tich->where('BiTich', 'Hôn phối')->count(),];
        return $analytics_bi_tich;
    }

    public function statisticAge(){
        $statistic_age = DB::table('so_gia_dinh_cong_giao as sgdcg')
            ->join('thanh_vien as tv', 'sgdcg.id', '=', 'tv.so_gia_dinh_id')
            ->orderBy('tv.created_at', 'DESC')
            ->where('sgdcg.giao_xu_id', $this->giao_xu_id)
            ->select('sgdcg.giao_xu_id',
                DB::raw("TIMESTAMPDIFF(YEAR, DATE(tv.ngay_sinh), current_date) as age"))
            ->get();
        $statistic_age_result = ['so_sinh' => $statistic_age->where('age', '<', 1)->count(),
            'nhi_dong' => $statistic_age->whereBetween('age', [1,5])->count(),
            'thieu_nhi' => $statistic_age->whereBetween('age', [6,17])->count(),
            'thanh_nien' => $statistic_age->whereBetween('age', [18, 40])->count(),
            'trung_nien' => $statistic_age->whereBetween('age', [41, 64])->count(),
            'tuoi_gia' => $statistic_age->where('age', '>', 65)->count()
        ];
        return $statistic_age_result;
    }

}
