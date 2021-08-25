<?php

namespace App\Http\Controllers;

use App\Models\BiTich;
use Illuminate\Http\Request;

class BiTichController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_bi_tich = BiTich::orderBy('created_at', 'DESC')
            ->get();
        return view('bi_tich.all', compact('all_bi_tich'));
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
     * @param  \App\Models\BiTich  $biTich
     * @return \Illuminate\Http\Response
     */
    public function show(BiTich $biTich)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BiTich  $biTich
     * @return \Illuminate\Http\Response
     */
    public function edit(BiTich $biTich)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BiTich  $biTich
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BiTich $biTich)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BiTich  $biTich
     * @return \Illuminate\Http\Response
     */
    public function destroy(BiTich $biTich)
    {
        //
    }
}
