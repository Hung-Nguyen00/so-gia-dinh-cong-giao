<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTuSiRequest;
use App\Http\Requests\TuSiRequest;
use App\Imports\ChucVuImport;
use App\Imports\LichSuCongTacImport;
use App\Imports\LichSuNhanChucImport;
use App\Imports\TuSIImport;
use App\Imports\ViTriImport;
use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use App\Models\GiaoXu;
use App\Models\LichSuCongTac;
use App\Models\LichSuNhanChuc;
use App\Models\NhaDong;
use App\Models\TenThanh;
use App\Models\TuSi;
use App\Models\ViTri;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use function Livewire\str;
use Maatwebsite\Excel\Facades\Excel;

class TuSiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->quanTri->ten_quyen == 'Giáo xứ'){
            Toastr::warning('Bạn không có quyền truy cập trang này', 'Cảnh báo');
           return redirect()->route('home');
        }else{
            $ten_giao_phan = GiaoPhan::find(Auth::user()->giao_phan_id)->ten_giao_phan;
            return view('tu_si.all', compact('ten_giao_phan'));
        }

    }

    public function fileImport(Request $request){

        try{
            DB::transaction(function () use ($request) {
                Excel::import(new TuSIImport(), $request->file('file')->store('temp'));
                Excel::import(new LichSuCongTacImport(), $request->file('file')->store('temp'));
                Excel::import(new LichSuNhanChucImport(), $request->file('file')->store('temp'));
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



    public function searchTuSi(Request $request){
        $chuc_vu = ChucVu::where('ten_chuc_vu', trim($request->chuc_vu))->first();
        if ($chuc_vu){
            if (Auth::user()->quanTri->ten_quyen == 'admin'){
                $all_tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu'])
                    ->where('chuc_vu_id', $chuc_vu->id)
                    ->whereNull('nha_dong_id')
                    ->orderBy('created_at', 'DESC')
                    ->get();
            }else{
                $all_tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu'])
                    ->where('giao_phan_id', Auth::user()->giao_phan_id)
                    ->where('chuc_vu_id', $chuc_vu->id)
                    ->orderBy('created_at', 'DESC')
                    ->get();
            }
            $chuc_vu_id = $chuc_vu->id;
            $ten_giao_phan = GiaoPhan::find(Auth::user()->giao_phan_id)->ten_giao_phan;
            $all_chuc_vu = ChucVu::all();
            return view('tu_si.all', compact('all_tu_si',
                'chuc_vu_id',
                'all_chuc_vu',
                'ten_giao_phan'));
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
        return view('tu_si.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTuSiRequest $request)
    {
        $validateData = $request->validated();
        $dang_du_hoc = 0;
        if (array_key_exists('dang_du_hoc', $validateData)){
            $dang_du_hoc = 1;
        }
        $tusi = TuSi::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id(), 'dang_du_hoc' => $dang_du_hoc]));
        if ($tusi){
            Toastr::success('Thêm mới tu sĩ thành công','Thành công');
            return redirect()->route('tu-si.edit', $tusi);
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
    public function edit(TuSi $tuSi)
    {
        $giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)
            ->orWhere('id',  Auth::user()->giao_xu_id)
            ->pluck('id');
        if (Auth::user()->quanTri->ten_quyen == 'admin') {
            $tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu', 'viTri'])
                ->where('id', $tuSi->id)->first();
        }elseif(Auth::user()->quanTri->ten_quyen == 'Giáo phận'){
            $tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu', 'viTri'])
                ->where('giao_phan_id', Auth::user()->giao_phan_id)
                ->whereId($tuSi->id)
                ->first();
        }else{
            $tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu', 'viTri'])
                ->whereIn('giao_xu_id', $giao_ho)
                ->whereId($tuSi->id)
                ->first();
        }
        if($tu_si){
            return view('tu_si.edit', compact('tu_si'));
        }else{
            return back();
        }
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TuSi  $tuSi
     * @return \Illuminate\Http\Response
     */
    public function destroy(TuSi $tuSi)
    {
        $tuSi->delete();
        Toastr::success('Xóa tu sĩ thành công','Thành công');
        return redirect()->route('tu-si.search', ['chuc_vu_id' => $tuSi->chuc_vu_id]);
    }
}
