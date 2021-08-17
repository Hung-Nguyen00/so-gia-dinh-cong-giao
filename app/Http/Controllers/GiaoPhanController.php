<?php

namespace App\Http\Controllers;

use App\Exports\GiaoPhanExport;
use App\Imports\GiaoHatImport;
use App\Imports\GiaoHoImport;
use App\Imports\GiaoPhanImport;
use App\Imports\GiaoXuImport;
use App\Models\GiaoPhan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GiaoPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_giao_phan = GiaoPhan::withCount('giaoHat')->get();
        return view('giao_phan.all_giao_phan', compact('all_giao_phan'));
    }

    public function fileImport(Request $request){
        Excel::import(new GiaoPhanImport(), $request->file('file')->store('temp'));
        Excel::import(new GiaoHatImport(), $request->file('file')->store('temp'));
        Excel::import(new GiaoXuImport(), $request->file('file')->store('temp'));
        Excel::import(new GiaoHoImport(), $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport(){
        return Excel::download(new GiaoPhanExport, 'giao-phan.xlsx');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
