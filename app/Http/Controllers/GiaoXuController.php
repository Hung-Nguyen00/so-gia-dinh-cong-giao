<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTuDongRequest;
use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\NhaDong;
use App\Models\TenThanh;
use App\Models\TuSi;
use App\Models\ViTri;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiaoXuController extends Controller
{
    public  function index(){
        if (Auth::user()->quanTri->ten_quyen == 'admin' || Auth::user()->quanTri->ten_quyen == 'Giáo phận' ){
            $all_giao_xu = GiaoXu::withCount('giaoHo')
                ->where('giao_xu_hoac_giao_ho', 0)
                ->orderBy('created_at', 'DESC')
                ->get();;
            return view('giao_xu.all_giao_xu', compact('all_giao_xu'));
        }else{
            return back();
        }
    }

    public function showTuSiByGiaoXu(){
        $all_tu_si = TuSi::with(['chucVu', 'tenThanh', 'viTri', 'nhaDong'])
            ->where('giao_xu_id', Auth::user()->giao_xu_id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('giao_xu.show_tu_si_by_user', compact('all_tu_si'));
    }


    public function createTuDong()
    {
        $all_ten_thanh = TenThanh::all();
        $all_vi_tri = ViTri::all();
        $all_chuc_vu = ChucVu::all();
        $all_nha_dong = NhaDong::all();
        return view('tu_si.add_tu_dong', compact(
            'all_chuc_vu',
            'all_ten_thanh',
                'all_nha_dong',
                'all_vi_tri'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTuDong(CreateTuDongRequest $request)
    {
        $validateData = $request->validated();
        $giao_xu = GiaoXu::with(['giaoPhan', 'giaoHat'])
            ->where('id', Auth::user()->giao_xu_id)
            ->first();
        $tusi = TuSi::create(array_merge($validateData,
            ['nguoi_khoi_tao' => Auth::id(),
             'giao_phan_id' => $giao_xu->giaoPhan->id,
              'giao_hat_id' => $giao_xu->giaoHat->id,
              'giao_xu_id' => $giao_xu->id,
            ]));
        if ($tusi){
            Toastr::success('Thêm mới tu sĩ thành công','Thành công');
            return redirect()->route('giaoXu.showTuSi');
        }else{
            Toastr::error('Không thể thêm tu sĩ mới','Lỗi');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TuSi  $tuSi
     * @return \Illuminate\Http\Response
     */
    public function show(TuSi $tuSi)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TuSi  $tuSi
     * @return \Illuminate\Http\Response
     */
    public function editTuDong(TuSi $tu_si)
    {
        $all_ten_thanh = TenThanh::all();
        $all_vi_tri = ViTri::all();
        $all_giao_phan = GiaoPhan::all();
        $all_giao_hat = GiaoHat::all();
        $all_giao_xu = GiaoXu::all();
        $all_chuc_vu = ChucVu::all();
        return view('tu_si.edit_tu_dong', compact('tu_si',
            'all_chuc_vu',
            'all_giao_hat',
            'all_giao_xu',
            'all_giao_phan',
            'all_ten_thanh',
            'all_vi_tri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TuSi  $tuSi
     * @return \Illuminate\Http\Response
     */
    public function updateTuDong(CreateTuDongRequest $request, TuSi $tuSi)
    {
        $validateData = $request->validated();
        $tuSi->update(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Cập nhập tu sĩ thành công','Thành công');
        return redirect()->route('giaoXu.showTuSi');
    }

    public function deleteTuDong(TuSi $tuSi)
    {
        $tuSi->delete();
        Toastr::success('Xóa tu sĩ thành công','Thành công');
        return redirect()->route('giaoXu.showTuSi');
    }
}
