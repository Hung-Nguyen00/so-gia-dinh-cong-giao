<?php

namespace App\Http\Controllers;

use App\Models\ThanhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThanhVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('sgdcg.all_thanh_vien');
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
     * @param  \App\Models\ThanhVien  $thanhVien
     * @return \Illuminate\Http\Response
     */
    public function show(ThanhVien $thanhVien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ThanhVien  $thanhVien
     * @return \Illuminate\Http\Response
     */
    public function edit(ThanhVien $thanhVien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ThanhVien  $thanhVien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThanhVien $thanhVien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ThanhVien  $thanhVien
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThanhVien $thanhVien)
    {
        //
    }
}
