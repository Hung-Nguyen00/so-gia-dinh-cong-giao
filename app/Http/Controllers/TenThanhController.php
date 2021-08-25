<?php

namespace App\Http\Controllers;

use App\Imports\ChucVuImport;
use App\Models\TenThanh;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class TenThanhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_ten_thanh = TenThanh::orderBy('created_at', 'DESC')->get();

        return view('ten_thanh.all_ten_thanh', compact('all_ten_thanh'));
    }


    public function fileImport(Request $request){

        try{
            Excel::import(new ChucVuImport(), $request->file('file')->store('temp'));
        }catch (\InvalidArgumentException $ex){
            Toastr::error('Các cột hoặc thông tin trong tệp không đúng dạng','Lỗi');
            return back();
        }catch (\Exception $ex){
            Toastr::error('Thông tin liên kết có thể chưa tồn tại trong hệ thống','Lỗi');
            return back();
        }catch(\Error $ex){
            Toastr::error('Các cột hoặc thông tin trong tệp không đúng dạng','Lỗi');
            return back();
        }
        Toastr::success('Thêm mới thành công','Thành công');
        return back();
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
