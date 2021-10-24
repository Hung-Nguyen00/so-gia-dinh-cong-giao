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
        $select_level='thieu_nhi',
        $ten_thanh_id,
        $ho_va_ten,
        $paginate_number,
        $ngay_sinh;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['select_level', 'ten_thanh_id', 'ho_va_ten', 'paginate_number', 'ngay_sinh'];



    public function mount(){
        $this->select_level = request()->query('select_level', $this->select_level);
        $this->ten_thanh_id = request()->query('ten_thanh_id', $this->ten_thanh_id);
        $this->paginate_number = request()->query('paginate_number', $this->paginate_number);
        $this->ho_va_ten = request()->query('ho_va_ten', $this->ho_va_ten);
        $this->ngay_sinh = request()->query('ngay_sinh', $this->ngay_sinh);

        $this->giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)
            ->orWhere('id', Auth::user()->giao_xu_id)
            ->pluck('id')->toArray();
        $this->all_thieu_nhi = $this->getThieuNhiByAge($this->giao_ho);
    }


    public function render()
    {
        $statistic_age = $this->statisticAge($this->giao_ho);
        $this->dispatchBrowserEvent('contentChanged');
        if ($this->select_level=='chien_non'){
            $get_level = $this->all_thieu_nhi->whereBetween('age', [3, 5]);
        }
        if ($this->select_level=='au_nhi'){
            $get_level = $this->all_thieu_nhi->whereBetween('age', [6, 10]);
        }
        if ($this->select_level=='thieu_nhi'){
            $get_level = $this->all_thieu_nhi->whereBetween('age', [11, 13]);
        }
        if ($this->select_level=='nghia_si'){
            $get_level = $this->all_thieu_nhi->whereBetween('age', [14, 16]);
        }
        if ($this->select_level=='hiep_si'){
            $get_level = $this->all_thieu_nhi->whereBetween('age', [17, 18]);
        }

        $all_ten_thanh = TenThanh::all();
        $get_all_id = $get_level->pluck('tv_id')->toArray();
        $showing_follow_level = DB::table('thanh_vien as tv')
            ->join('ten_thanh as t', 't.id', '=', 'tv.ten_thanh_id')
            ->join('so_gia_dinh_cong_giao as sgd', 'sgd.id', '=', 'tv.so_gia_dinh_id')
            ->select('tv.id as tv_id',
                'tv.so_gia_dinh_id',
                'tv.ho_va_ten',
                'tv.ngay_sinh',
                'sgd.id as sgd_id',
                'tv.ten_thanh_id',
                't.ten_thanh',
                'tv.dia_chi_hien_tai',
                'tv.so_dien_thoai')
            ->whereIn('tv.id', $get_all_id);

        if ($this->ten_thanh_id){
            $showing_follow_level->where('ten_thanh_id', $this->ten_thanh_id);
        }if ($this->ho_va_ten){
            $showing_follow_level->where('ho_va_ten', 'like', "%$this->ho_va_ten%");
        }if ($this->ngay_sinh){
            $showing_follow_level->where('ngay_sinh', $this->ngay_sinh);
        }
        return view('livewire.giao-xu.thieu-nhi')->with([
            'showing_follow_level' => $showing_follow_level->paginate(20),
            'all_ten_thanh' => $all_ten_thanh,
        ]);
    }


    public function statisticAge($giao_ho){
        $count_chien_non = 0;
        $count_au_nhi = 0;
        $count_thieu_nhi = 0;
        $count_nghia_si = 0;
        $count_hiep_xi = 0;
        DB::table('giao_xu as x')
            ->join('so_gia_dinh_cong_giao as sgdcg', 'x.id', '=', 'sgdcg.giao_xu_id')
            ->join('thanh_vien as tv', 'sgdcg.id', '=', 'tv.so_gia_dinh_id')
            ->whereIn('x.id', $giao_ho)
            ->orderBy('tv.created_at', 'DESC')
            ->select('tv.id as ThanhVien',
                DB::raw("TIMESTAMPDIFF(YEAR, DATE(tv.ngay_sinh), current_date) AS age"))
            ->chunk(1000, function ($value)
            use(
                &$count_chien_non,
                &$count_thieu_nhi,
                &$count_au_nhi,
                &$count_nghia_si,
                &$count_hiep_xi){
                $count_chien_non += $value->whereBetween('age', [3, 5])->count();
                $count_thieu_nhi += $value->whereBetween('age', [6, 10])->count();
                $count_au_nhi += $value->whereBetween('age', [11, 13])->count();
                $count_nghia_si += $value->whereBetween('age', [14, 16])->count();
                $count_hiep_xi += $value->whereBetween('age', [17, 18])->count();
            });
        $statistic_thieu_nhi = ['count_chien_non' => $count_chien_non,
            'count_thieu_nhi' => $count_thieu_nhi,
            'count_au_nhi' => $count_au_nhi,
            'count_nghia_si' => $count_nghia_si,
            'count_hiep_xi' => $count_hiep_xi];

        return $statistic_thieu_nhi;
    }

    public function getThieuNhiByAge($giao_ho){
        $thieu_nhi = DB::table('giao_xu as x')
            ->join('so_gia_dinh_cong_giao as sgdcg', 'x.id', '=', 'sgdcg.giao_xu_id')
            ->join('thanh_vien as tv', 'sgdcg.id', '=', 'tv.so_gia_dinh_id')
            ->join('ten_thanh as t', 't.id', '=','tv.ten_thanh_id')
            ->whereIn('x.id', $giao_ho)
            ->orderBy('tv.ngay_sinh', 'ASC')
            ->select('tv.id as tv_id',
                'ho_va_ten',
                'ngay_sinh',
                'so_gia_dinh_id as sgd_id',
                'ten_thanh',
                'so_dien_thoai',
                'dia_chi',
                DB::raw("TIMESTAMPDIFF(YEAR, DATE(tv.ngay_sinh), current_date) AS age"))
            ->get()
            ->whereBetween('age', [3, 18]);
        return $thieu_nhi;
    }
}
