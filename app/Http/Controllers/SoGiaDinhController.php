<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateThanhVienRequest;
use App\Models\BiTich;
use App\Models\GiaoXu;
use App\Models\SoGiaDinh;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoGiaDinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_so_gia_dinh = SoGiaDinh::withCount('thanhVien')
            ->where('giao_xu_id', Auth::user()->giao_xu_id)->get();
        $ten_giao_xu = GiaoXu::where('id', Auth::user()->giao_xu_id)->first()->ten_giao_xu;
        return view('sgdcg.all', compact('all_so_gia_dinh', 'ten_giao_xu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function indexThanhVien($id){

        dd($id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SoGiaDinh  $soGiaDinh
     * @return \Illuminate\Http\Response
     */
    public function show(SoGiaDinh $soGiaDinh)
    {
        $all_thanh_vien = ThanhVien::with(['tenThanh'])->withCount('biTich')
            ->where('so_gia_dinh_id', $soGiaDinh->id)->get();
        return view('sgdcg.thanh_vien', compact('all_thanh_vien', 'soGiaDinh'));
    }

    public function createThanhVien($sgdId){
        $all_ten_thanh  = TenThanh::all();
        $sgdcg = SoGiaDinh::find($sgdId);
        return view('sgdcg.add_thanh_vien', compact('all_ten_thanh', 'sgdcg'));
    }

    public function storeThanhVien(CreateThanhVienRequest $request, $sgdId){
        $validateData = $request->validated();
        if (array_key_exists('nam_sinh', $validateData )){
            $validateData['ngay_sinh'] =  $validateData['nam_sinh'].'/01/01';
            ThanhVien::create(array_merge($validateData,
                ['nguoi_khoi_tao' => Auth::id(),
                  'so_gia_dinh_id' => $sgdId]));
        }else{
            ThanhVien::create(array_merge($validateData,
                ['nguoi_khoi_tao' => Auth::id(),
                    'so_gia_dinh_id' => $sgdId]));
        }
        Toastr::success('Thêm mới thành công', 'success');
        return redirect()->route('so-gia-dinh.show', SoGiaDinh::find($sgdId));
    }

    public function  editThanhVien($sgdId,$tv_id){
        $thanh_vien = ThanhVien::with('biTich')->find($tv_id);
        $sgdcg = SoGiaDinh::find($sgdId);
        $all_ten_thanh = TenThanh::all();
        $all_tu_si = TuSi::all();
        $all_bi_tich = BiTich::whereDoesntHave('thanhVien', function($q) use($thanh_vien) {
            $q->where('thanh_vien_id', $thanh_vien->id);
        })->get();
        return view('sgdcg.edit_thanh_vien',
            compact('all_bi_tich', 'all_ten_thanh', 'all_tu_si', 'thanh_vien', 'sgdcg'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SoGiaDinh  $soGiaDinh
     * @return \Illuminate\Http\Response
     */
    public function edit(SoGiaDinh $soGiaDinh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SoGiaDinh  $soGiaDinh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoGiaDinh $soGiaDinh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SoGiaDinh  $soGiaDinh
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoGiaDinh $soGiaDinh)
    {
        //
    }
}
