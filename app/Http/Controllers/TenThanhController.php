<?php

namespace App\Http\Controllers;

use App\Models\TenThanh;
use Illuminate\Http\Request;

class TenThanhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_ten_thanh = TenThanh::all();

        return view('ten_thanh.all_ten_thanh', compact('all_ten_thanh'));
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
     * @param  \App\Models\TenThanh  $tenThanh
     * @return \Illuminate\Http\Response
     */
    public function show(TenThanh $tenThanh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TenThanh  $tenThanh
     * @return \Illuminate\Http\Response
     */
    public function edit(TenThanh $tenThanh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TenThanh  $tenThanh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TenThanh $tenThanh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TenThanh  $tenThanh
     * @return \Illuminate\Http\Response
     */
    public function destroy(TenThanh $tenThanh)
    {
        //
    }
}
