<?php

namespace App\Http\Controllers;

use App\Http\Requests\TuSiRequest;
use App\Imports\ChucVuImport;
use App\Imports\LichSuCongTacImport;
use App\Imports\TuSIImport;
use App\Imports\ViTriImport;
use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\LichSuCongTac;
use App\Models\LichSuNhanChuc;
use App\Models\TenThanh;
use App\Models\TuSi;
use App\Models\ViTri;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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
        $all_tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu'])->get();

        return view('tu_si.all', compact('all_tu_si'));
    }

    public function fileImport(Request $request){
        try{
            Excel::import(new ChucVuImport(), $request->file('file')->store('temp'));
            Excel::import(new ViTriImport(), $request->file('file')->store('temp'));
            Excel::import(new TuSIImport(), $request->file('file')->store('temp'));
            Excel::import(new LichSuCongTacImport(), $request->file('file')->store('temp'));
        }catch (\InvalidArgumentException $ex){
            Toastr::error('Các cột trong tệp Excel không đúng dạng','Error');
            return back();
        }catch (\Exception $ex){
            Toastr::error('Các cột trong tệp Excel không đúng dạng','Error');
            return back();
        }catch(\Error $ex){
            Toastr::error('Các cột trong tệp Excel không đúng dạng','Error');
            return back();
        }
        Toastr::success('Thêm mới thành công','Success');
        return back();
    }

//    public function fileExport(){
//        return Excel::download(new GiaoPhanExport, 'giao-phan.xlsx');
//    }


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
            'all_ten_thanh'
            ));
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
        $dang_du_hoc = 0;
        if (array_key_exists('dang_du_hoc', $validateData)){
            $dang_du_hoc = 1;
        }
        $tusi = TuSi::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id(), 'dang_du_hoc' => $dang_du_hoc]));
        if ($tusi){
            Toastr::success('Thêm mới tu sĩ thành công','Success');
            return redirect()->route('tu-si.search',
                ['chuc_vu_id' => $tusi->chuc_vu_id]);
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
        $tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu', 'viTri'])
                    ->where('id', $tuSi->id)->first();
        $all_ten_thanh = TenThanh::all();
        $all_giao_xu = GiaoXu::all();
        $all_giao_hat = GiaoHat::all();
        $all_vi_tri = ViTri::all();
        $all_giao_phan = GiaoPhan::with('giaoTinh')->get();
        $all_chuc_vu = ChucVu::all();
        return view('tu_si.edit', compact('tu_si',
            'all_chuc_vu',
            'all_giao_xu',
            'all_giao_hat',
            'all_giao_phan',
            'all_ten_thanh',
            'all_vi_tri'));
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
        $dang_du_hoc = 0;
        // save old info when change GX.
        $old_tu_si = $tuSi;
        // check textbox from form
        if (array_key_exists('dang_du_hoc', $validateData)){
            $dang_du_hoc = 1;
        }
        if ($validateData['check_save_info'] == 1){

            // save info when change Chuc_Vu to lich_su_nhan_chuc table
            if ($validateData['chuc_vu_id'] !== $tuSi->chuc_vu_id && $validateData['ngay_nhan_chuc'] !== $tuSi->ngay_nhan_chuc ){
                LichSuNhanChuc::create([
                    'ngay_nhan_chuc' => $old_tu_si->ngay_nhan_choi,
                    'noi_nhan_chuc' => $old_tu_si->noi_nhan_chuc,
                    'chuc_vu' => $old_tu_si->chucVu->ten_chuc_vu,
                    'tu_si_id' => $tuSi->id,
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
            }
            $tuSi->update(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id(), 'dang_du_hoc' => $dang_du_hoc]));
            Toastr::success('Cập nhập tu sĩ thành công','Success');
            return redirect()->route('tu-si.edit', $tuSi);
        }else{
            // save info when change GX to lich_su_cong_tac table

            if ($validateData['bat_dau_phuc_vu'] == null){
                throw ValidationException::withMessages(['bat_dau_phuc_vu' => 'Ngày bắt đầu phục vụ không được phép trống']);
            }
            if ($validateData['ket_thuc_phuc_vu'] == null){
                throw ValidationException::withMessages(['ket_thuc_phuc_vu' => 'Ngày kết thúc phục vụ không được phép trống']);
            }
            if ($validateData['giao_xu_id'] == null){
                throw ValidationException::withMessages(['giao_xu_id' => 'Giáo xứ không được phép trống']);
            }
            if ($validateData['vi_tri_id'] == null){
                throw ValidationException::withMessages(['giao_xu_id' => 'Vị trí không được phép trống']);
            }
            $tuSi->update(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id(), 'dang_du_hoc' => $dang_du_hoc]));
             LichSuCongTac::create([
                 'tu_si_id' => $tuSi->id,
               'ten_giao_phan' => $old_tu_si->giaoPhan->ten_giao_phan,
                'ten_giao_hat' => $old_tu_si->giaoHat->ten_giao_hat,
                'ten_giao_xu' => $old_tu_si->giaoXu->ten_giao_xu,
                'bat_dau_phuc_vu' => $old_tu_si->bat_dau_phuc_vu,
                'ket_thuc_phuc_vu' => $tuSi->ket_thuc_phuc_vu,
                'ten_vi_tri' => $old_tu_si->viTri->ten_vi_tri
            ]);
            Toastr::success('Cập nhập tu sĩ thành công','Success');
            return redirect()->route('tu-si.edit', $tuSi);
        }


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
        Toastr::success('Xóa tu sĩ thành công','Success');
        return redirect()->route('tu-si.search', ['chuc_vu_id' => $tuSi->chuc_vu_id]);
    }
}
