<?php

namespace App\Http\Livewire\GiaoXu;

use App\Models\GiaoXu;
use App\Models\TenThanh;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ThieuNhi extends Component
{
    use WithPagination;
    public $all_thieu_nhi,
        $giao_ho,
        $select_level='chien_non',
        $ten_thanh_id,
        $ho_va_ten,
        $giao_xu_id,
        $paginate_number,
        $all_giao_xu,
        $ngay_sinh;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['select_level', 'ten_thanh_id', 'giao_xu_id', 'ho_va_ten', 'paginate_number', 'ngay_sinh'];



    public function mount(){
        $this->select_level = request()->query('select_level', $this->select_level);
        $this->ten_thanh_id = request()->query('ten_thanh_id', $this->ten_thanh_id);
        $this->giao_xu_id = request()->query('giao_xu_id', $this->giao_xu_id);
        $this->paginate_number = request()->query('paginate_number', $this->paginate_number);
        $this->ho_va_ten = request()->query('ho_va_ten', $this->ho_va_ten);
        $this->ngay_sinh = request()->query('ngay_sinh', $this->ngay_sinh);

        $this->all_giao_xu = GiaoXu::with('giaoHat')->where('giao_xu_hoac_giao_ho', 0)->get();
        if (!$this->giao_xu_id){
            $this->giao_xu_id = Auth::user()->giao_xu_id;
        }
    }


    public function render()
    {
        if ($this->giao_xu_id !== Auth::user()->giao_xu_id){
            $giao_xu_id = $this->giao_xu_id;
        }else{
            $giao_xu_id = Auth::user()->giao_xu_id;
        }

        $this->giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', $giao_xu_id)
            ->orWhere('id', $giao_xu_id)
            ->pluck('id')->toArray();
        $this->dispatchBrowserEvent('contentChanged');
        $timestamps = 'TIMESTAMPDIFF(YEAR, DATE(tv.ngay_sinh), current_date)';
        $all_ten_thanh = TenThanh::all();
        $showing_follow_level = DB::table('thanh_vien as tv')
            ->join('ten_thanh as t', 't.id', '=', 'tv.ten_thanh_id')
            ->join('so_gia_dinh_cong_giao as sgd', 'sgd.id', '=', 'tv.so_gia_dinh_id')
            ->select('tv.id as tv_id',
                'tv.so_gia_dinh_id as sgd_id',
                'tv.ho_va_ten',
                'sgd.giao_xu_id as giao_xu_id',
                'tv.ten_thanh_id',
                'tv.ngay_sinh',
                't.ten_thanh',
                'tv.dia_chi_hien_tai',
                'tv.so_dien_thoai',
                DB::raw("TIMESTAMPDIFF(YEAR, DATE(tv.ngay_sinh), current_date) AS age")
                )
            ->whereIn('giao_xu_id', $this->giao_ho);
        // 3-5 6-10 11-13 14-16 17-18
        if ($this->select_level=='chien_non'){
            $showing_follow_level = $showing_follow_level->whereRaw("{$timestamps} > 2 and {$timestamps} < 6");
        }
        if ($this->select_level=='au_nhi'){
            $showing_follow_level = $showing_follow_level->whereRaw("{$timestamps} > 5 and {$timestamps} < 11");
        }
        if ($this->select_level=='thieu_nhi'){
            $showing_follow_level = $showing_follow_level->whereRaw("{$timestamps} > 10 and {$timestamps} < 14");
        }
        if ($this->select_level=='nghia_si'){
            $showing_follow_level =$showing_follow_level->whereRaw("{$timestamps} > 13 and {$timestamps} < 17");
        }
        if ($this->select_level=='hiep_si'){
            $showing_follow_level = $showing_follow_level->whereRaw("{$timestamps} > 16 and {$timestamps} < 19");
        }

        if ($this->ten_thanh_id){
            $showing_follow_level->where('ten_thanh_id', $this->ten_thanh_id);
        }if ($this->ho_va_ten){
            $showing_follow_level->where('ho_va_ten', 'like', "%$this->ho_va_ten%");
        }if ($this->ngay_sinh){
            $showing_follow_level->where('ngay_sinh', $this->ngay_sinh);
        }
        return view('livewire.giao-xu.thieu-nhi')->with([
            'showing_follow_level' => $showing_follow_level->simplePaginate(20),
            'all_ten_thanh' => $all_ten_thanh,
        ]);
    }


    public function statisticAge($giao_ho){
        $statistic_thieu_nhi = DB::table('giao_xu as x')
            ->join('so_gia_dinh_cong_giao as sgdcg', 'x.id', '=', 'sgdcg.giao_xu_id')
            ->join('thanh_vien as tv', 'sgdcg.id', '=', 'tv.so_gia_dinh_id')
            ->whereIn('x.id', $giao_ho)
            ->orderBy('tv.created_at', 'DESC')
            ->select('tv.id as ThanhVien',
                DB::raw("TIMESTAMPDIFF(YEAR, DATE(tv.ngay_sinh), current_date) AS age"))
            ->get();
        $statistic_thieu_nhi = [
            'count_chien_non' => $statistic_thieu_nhi->whereBetween('age', [3, 5])->count(),
            'count_au_nhi' => $statistic_thieu_nhi->whereBetween('age', [6, 10])->count(),
            'count_thieu_nhi' => $statistic_thieu_nhi->whereBetween('age', [11, 13])->count(),
            'count_nghia_si' => $statistic_thieu_nhi->whereBetween('age', [14, 16])->count(),
            'count_hiep_xi' => $statistic_thieu_nhi->whereBetween('age', [17, 18])->count()
        ];

        return $statistic_thieu_nhi;
    }
}
