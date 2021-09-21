<?php

namespace App\Http\Controllers;

use App\Exports\GiaoPhanExport;
use App\Imports\GiaoHatImport;
use App\Imports\GiaoHoImport;
use App\Imports\GiaoPhanImport;
use App\Imports\GiaoTinhImport;
use App\Imports\GiaoXuImport;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $all_giao_phan = GiaoPhan::with('getUser')
            ->withCount('giaoHat')
            ->orderBy('created_at', 'DESC')
            ->get();;

        return view('giao_phan.all_giao_phan', compact('all_giao_phan'));
    }



    public function indexGiaoPhan(){
        return view('dashboard.statictis_giao_phan');
    }

    public function indexGiaoXu(){
        $giao_xu = GiaoXu::with(['giaoDan.biTich', 'giaoHo'])->withCount(['tuSi', 'giaoDan', 'giaoHo'])
            ->where('id', Auth::user()->giao_xu_id)
            ->first();
        $static_ket_hon = 0;
        $static_tu = 0;
        $static_sinh = 0;
        if ($giao_xu != null && $giao_xu->giaoDan->count() > 0){
            foreach($giao_xu->giaoDan as $g){
                if ( $g->biTich->count() == 4){
                     $static_ket_hon ++;
                }
                if ( $g->biTich->count() == 1){
                    $static_sinh ++;
                }
                if ($g->ngay_mat !== null){
                    $static_tu ++;
                }
            }
        }
        $linh_muc = TuSi::with('tenThanh')->whereHas('viTri', function ($q){
            $q->where('ten_vi_tri', 'Cha xứ');
        })->where('giao_xu_id', Auth::user()->giao_xu_id)->first();

        return view('dashboard.static_giao_xu', compact(
            'giao_xu',
            'static_tu',
            'static_ket_hon',
            'static_sinh',
            'linh_muc'));
    }

    public function fileImport(Request $request){

        try{
            DB::transaction(function () use ($request) {
                Excel::import(new GiaoPhanImport(), $request->file('file')->store('temp'));
                Excel::import(new GiaoHatImport(), $request->file('file')->store('temp'));
                Excel::import(new GiaoXuImport(), $request->file('file')->store('temp'));
                Excel::import(new GiaoHoImport(), $request->file('file')->store('temp'));
            });
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
