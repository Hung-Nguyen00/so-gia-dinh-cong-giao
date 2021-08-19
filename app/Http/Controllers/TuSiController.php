<?php

namespace App\Http\Controllers;

use App\Http\Requests\TuSiRequest;
use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TuSiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu'])->get();

        return view('tu_si.all', compact('all_tu_si'));
    }

    public function searchTuSi(Request $request){

        if (ChucVu::find($request->chuc_vu_id)){
            $all_tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu'])
                ->where('chuc_vu_id', $request->chuc_vu_id)->get();
            $chuc_vu_id = ChucVu::find($request->chuc_vu_id)->id;
            $all_chuc_vu = ChucVu::all();
            return view('tu_si.all', compact('all_tu_si', 'chuc_vu_id', 'all_chuc_vu'));
        }else{
            return back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_ten_thanh = TenThanh::all();
        $all_giao_xu = GiaoXu::with('giaoHat')->get();
        $all_giao_hat = GiaoHat::with('giaoPhan')->get();
        $all_giao_phan = GiaoPhan::with('giaoTinh')->get();
        $all_chuc_vu = ChucVu::all();
        return view('tu_si.add', compact(
            'all_chuc_vu',
            'all_giao_xu',
            'all_giao_hat',
            'all_giao_phan',
            'all_ten_thanh'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TuSiRequest $request)
    {
        $validateData = $request->validated();
        $tusi = TuSi::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
        if ($tusi){
            Toastr::success('Thêm mới tu sĩ thành công','Success');
            return redirect()->route('tu-si.search', ['chuc_vu_id' => $tusi->chuc_vu_id]);
        }else{
            Toastr::error('Không thể thêm tu sĩ mới','Error');
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
    public function edit(TuSi $tuSi)
    {
        $tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu'])
                    ->where('id', $tuSi->id)->first();
        $all_ten_thanh = TenThanh::all();
        $all_giao_xu = GiaoXu::all();
        $all_giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', '<>', 0)->get();
        $all_giao_hat = GiaoHat::all();
        $all_giao_phan = GiaoPhan::all();
        $all_chuc_vu = ChucVu::all();
        return view('tu_si.edit', compact('tu_si',
            'all_chuc_vu',
            'all_giao_xu',
            'all_giao_hat',
            'all_giao_phan',
            'all_ten_thanh',
            'all_giao_ho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TuSi  $tuSi
     * @return \Illuminate\Http\Response
     */
    public function update(TuSiRequest $request, TuSi $tuSi)
    {
        $validateData = $request->validated();
        if ($validateData['ket_thuc_phuc_vu']){

        }
        $tuSi->update(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Cập nhập tu sĩ thành công','Success');
        return redirect()->route('tu-si.search', ['chuc_vu_id' => $tuSi->chuc_vu_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TuSi  $tuSi
     * @return \Illuminate\Http\Response
     */
    public function destroy(TuSi $tuSi)
    {
        //
    }
}
