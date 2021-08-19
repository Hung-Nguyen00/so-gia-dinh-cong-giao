<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use App\Models\TuSi;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
        $all_giao_hat = GiaoHat::all();
        $all_giao_phan = GiaoPhan::all();
        $all_chuc_vu = ChucVu::all();
        return view('tu_si.edit', compact('tu_si',
            'all_chuc_vu',
            'all_giao_xu',
            'all_giao_hat',
            'all_giao_phan',
            'all_ten_thanh'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TuSi  $tuSi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuSi $tuSi)
    {
        //
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
