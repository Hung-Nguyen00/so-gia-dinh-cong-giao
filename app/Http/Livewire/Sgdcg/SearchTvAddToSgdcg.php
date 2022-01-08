<?php

namespace App\Http\Livewire\Sgdcg;

use App\Models\BiTichDaNhan;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchTvAddToSgdcg extends Component
{
    public $soGiaDinh,
        $giao_phan_id = null,
        $giao_xu_id = null,
        $ten_thanh_id = null,
        $ngay_sinh = null,
        $chuc_vu_gd,
        $gioi_tinh = null,
        $thanh_vien_id = null;

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $all_giao_phan = GiaoPhan::select('id', 'ten_giao_phan')->get();
        $all_ten_thanh = TenThanh::select('id', 'ten_thanh')->get();
        $giao_phan_id = $this->giao_phan_id;

        $all_giao_xu = GiaoXu::with('giaoHat')
            ->whereHas('giaoHat', function ($q) use ($giao_phan_id){
                $q->where('giao_phan_id', $giao_phan_id);
        })->select('id', 'ten_giao_xu', 'giao_hat_id')->get();

        $thanh_vien = DB::table('so_gia_dinh_cong_giao as sgd')
                ->join('thanh_vien as tv', 'sgd.id', '=', 'tv.so_gia_dinh_id')
                ->join('ten_thanh as tt' , 'tv.ten_thanh_id', '=', 'tt.id')
                ->select('ngay_sinh', 'tt.id as ten_thanh_id','tv.id as thanh_vien_id',
                    'ten_thanh',
                    'sgd.id as sgdId',
                    'gioi_tinh',
                    'ho_va_ten',
                    'chuc_vu_gd',
                    'chuc_vu_gd_2',
                    'sgd.giao_xu_id'
               )
                ->where('ngay_sinh', $this->ngay_sinh)
                ->where('gioi_tinh', $this->gioi_tinh)
                ->where('ten_thanh_id', $this->ten_thanh_id)
                ->where('giao_xu_id', $this->giao_xu_id)
                ->get();

        $info_thanh_vien = array();

        $key = 0;
        if ($thanh_vien->count() > 0){
            foreach ($thanh_vien as $tv){

                $id = $tv->sgdId;
                $query = DB::table('thanh_vien as tv')
                    ->join('ten_thanh as tt' , 'tv.ten_thanh_id', '=', 'tt.id')
                    ->select('ho_va_ten', 'ten_thanh', 'chuc_vu_gd', 'chuc_vu_gd_2',
                        'so_gia_dinh_id', 'so_gia_dinh_id_2')
                    ->where(function ($q) use ($id){
                        $q->where('so_gia_dinh_id', $id)
                            ->orWhere('so_gia_dinh_id_2', $id);
                    })->get();;
                $info_thanh_vien[$key]['ten_thanh_vien'] = $tv->ho_va_ten;
                $info_thanh_vien[$key]['id'] = $tv->thanh_vien_id;
                foreach($query as $q){
                    if ($q->chuc_vu_gd == 'Cha' ||  $q->chuc_vu_gd_2 == 'Cha'){
                        $info_thanh_vien[$key]['ten_thanh_cha'] = $q->ten_thanh;
                        $info_thanh_vien[$key]['ho_ten_cha'] = $q->ho_va_ten;
                    }
                    if ($q->chuc_vu_gd == 'Mẹ' ||  $q->chuc_vu_gd_2 == 'Mẹ'){
                        $info_thanh_vien[$key]['ten_thanh_me'] = $q->ten_thanh;
                        $info_thanh_vien[$key]['ho_ten_me'] = $q->ho_va_ten;
                    }
                }
                $key++;
            }
            $thanh_vien = $info_thanh_vien;
        }
        return view('livewire.sgdcg.search-tv-add-to-sgdcg', compact(
            'all_giao_phan',
                    'all_giao_xu',
                        'all_ten_thanh',
                        'thanh_vien'));
    }

    public function mount($soGiaDinh){
        $this->soGiaDinh = $soGiaDinh;
    }

    public function store(){
        if($this->gioi_tinh == 1){
            $this->chuc_vu_gd = "Cha";
        }
        if($this->gioi_tinh == 0){
            $this->chuc_vu_gd = "Mẹ";
        }
        $thanh_vien_found = DB::table('thanh_vien')
            ->select('id', 'so_gia_dinh_id_2', 'chuc_vu_gd_2')
            ->where('id', $this->thanh_vien_id)->limit(1);
        $exist_tv_sgd = DB::table('thanh_vien as tv')
                        ->join('bi_tich_da_nhan as btdn', 'btdn.thanh_vien_id', '=', 'tv.id')
                        ->join('bi_tich as bt', 'bt.id', '=', 'btdn.bi_tich_id')
                        ->select(
                            'btdn.bi_tich_id as bi_tich_id',
                            'ten_nguoi_lam_chung_1',
                            'ten_thanh_nguoi_lam_chung_1',
                            'ten_bi_tich',
                            'ngay_sinh_nguoi_lam_chung_1',
                            'ten_nguoi_lam_chung_2',
                            'ten_thanh_nguoi_lam_chung_2',
                            'ngay_sinh_nguoi_lam_chung_2',
                            'ngay_dien_ra',
                            'noi_dien_ra',
                            'tu_si_id')
                        ->where('tv.so_gia_dinh_id', $this->soGiaDinh->id)
                        ->orWhere('tv.so_gia_dinh_id_2', $this->soGiaDinh->id)
                        ->where('ten_bi_tich', 'Hôn phối')
                        ->first();
        if ($thanh_vien_found){
            try{
                DB::transaction(function () use($thanh_vien_found, $exist_tv_sgd){
                    $thanh_vien_found->update([
                        'so_gia_dinh_id_2' => $this->soGiaDinh->id,
                        'chuc_vu_gd_2' => $this->chuc_vu_gd,
                    ]);
                    BiTichDaNhan::create([
                        'bi_tich_id' => $exist_tv_sgd->bi_tich_id,
                        'ten_nguoi_lam_chung_1' => $exist_tv_sgd->ten_nguoi_lam_chung_1,
                        'ten_thanh_nguoi_lam_chung_1' => $exist_tv_sgd->ten_thanh_nguoi_lam_chung_1,
                        'ngay_sinh_nguoi_lam_chung_1' => $exist_tv_sgd->ngay_sinh_nguoi_lam_chung_1,
                        'ten_nguoi_lam_chung_2' => $exist_tv_sgd->ten_nguoi_lam_chung_2,
                        'ten_thanh_nguoi_lam_chung_2' => $exist_tv_sgd->ten_thanh_nguoi_lam_chung_2,
                        'ngay_sinh_nguoi_lam_chung_2' => $exist_tv_sgd->ngay_sinh_nguoi_lam_chung_2,
                        'ngay_dien_ra'  => $exist_tv_sgd->ngay_dien_ra,
                        'noi_dien_ra'   => $exist_tv_sgd->noi_dien_ra,
                        'tu_si_id'  => $exist_tv_sgd->tu_si_id,
                        'thanh_vien_id' => $thanh_vien_found->first()->id,
                        'nguoi_khoi_tao' => Auth::id(),
                    ]);
                });
            }catch (\Exception $ex){
                Toastr::error('Có lỗi khi thêm thành viên', 'Lỗi');
                return redirect()->route('so-gia-dinh.show', $this->soGiaDinh);
            }
            Toastr::success('Thêm mới thành công', 'Thành công');
            return redirect()->route('so-gia-dinh.show', $this->soGiaDinh);
        }else{
            Toastr::error('Không tìm thấy', 'Lỗi');
            return redirect()->route('so-gia-dinh.show', $this->soGiaDinh);
        }
    }
}
