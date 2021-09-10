<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateThanhVienRequest;
use App\Imports\BiTichDaNhanImport;
use App\Imports\ImportBiTichXTTS;
use App\Imports\SoGiaDinhImport;
use App\Imports\ThanhVienImport;
use App\Models\BiTich;
use App\Models\BiTichDaNhan;
use App\Models\GiaoXu;
use App\Models\SoGiaDinh;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use App\Models\TuSi;
use Barryvdh\DomPDF\Facade as PDF;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class SoGiaDinhController extends Controller
{
    // SoGiaDinh Info
    public function index()
    {
        // get value match GiaoXu because Account has role which is GiaoXU and then only see it's data
        // thanhVienSo2 is ThanhVien from a existing SoGiaDinh and He or she will have new SoGiDinh.
        // Thus, We need show number of thanhvien from that SogiaDinh by so_gia_dinh_id_2
      $all_so_gia_dinh = SoGiaDinh::with('getUser')
          ->withCount(['thanhVien', 'thanhVienSo2'])
            ->where('giao_xu_id', Auth::user()->giao_xu_id)
            ->orderBy('created_at', 'DESC')
            ->get();
    $ten_giao_xu = GiaoXu::where('id', Auth::user()->giao_xu_id)->first();
    if ($ten_giao_xu == null){
        return back();
    }else{
        $ten_giao_xu = $ten_giao_xu->ten_giao_xu;
    }
    return view('sgdcg.all', compact('all_so_gia_dinh', 'ten_giao_xu'));
    }

    public function show(SoGiaDinh $soGiaDinh)
    {
        $all_thanh_vien = ThanhVien::with(['tenThanh', 'getUser'])->withCount('biTich')
            ->where('so_gia_dinh_id', $soGiaDinh->id)
            ->orWhere('so_gia_dinh_id_2', $soGiaDinh->id)->get();
        return view('sgdcg.thanh_vien', compact('all_thanh_vien', 'soGiaDinh'));
    }



    public  function downloadPDF($id){
        $sgdcg = SoGiaDinh::with(['giaoXu.giaoPhan'])->withCount(['thanhVien', 'thanhVienSo2'])->find($id);
        if ($sgdcg->thanh_vien_count == 0 && $sgdcg->thanh_vien_so2_count == 0){
            Toastr::warning('Không có dữ liệu', 'Cảnh báo');
            return back();
        }
        $query_so_gia_dinh_id = DB::table('thanh_vien as tv')
            ->join('ten_thanh as t', 't.id', '=', 'tv.ten_thanh_id')
            ->where('so_gia_dinh_id', $sgdcg->id)
            ->select('tv.id as thanh_vien_id',
                'tv.dia_chi_hien_tai',
                'tv.so_dien_thoai',
                'chuc_vu_gd',
                'noi_sinh',
                'giao_xu',
                'giao_phan',
                'chuc_vu_gd_2',
                'tv.so_gia_dinh_id',
                'ho_va_ten',
                'ten_thanh',
                'ngay_sinh')->get();
        $query_so_gia_dinh_id_2 = DB::table('thanh_vien as tv')
            ->join('ten_thanh as t', 't.id', '=', 'tv.ten_thanh_id')
            ->where('so_gia_dinh_id_2', $sgdcg->id)
            ->select('tv.id as thanh_vien_id',
                'tv.dia_chi_hien_tai',
                'tv.so_dien_thoai',
                'tv.so_gia_dinh_id',
                'chuc_vu_gd_2',
                'noi_sinh',
                'ho_va_ten',
                'giao_xu',
                'giao_phan',
                'ten_thanh',
                'ngay_sinh')->get();
        $query_bi_tich = DB::table('bi_tich_da_nhan as btdn')
            ->join('tu_si as ts', 'ts.id', '=', 'btdn.tu_si_id')
            ->join('ten_thanh as tt', 'tt.id', '=', 'ts.ten_thanh_id')
            ->join('bi_tich as bt', 'bt.id', '=', 'btdn.bi_tich_id')
            ->select('btdn.thanh_vien_id as thanh_vien_id',
                'ts.ho_va_ten as ten_linh_muc',
                'ten_bi_tich',
                'tt.ten_thanh as ten_thanh_linh_muc',
                'ngay_dien_ra',
                'noi_dien_ra',
                'ten_nguoi_lam_chung_1',
                'ten_thanh_nguoi_lam_chung_1',
                'ten_nguoi_lam_chung_2',
                'ten_thanh_nguoi_lam_chung_2',
                'ten_nguoi_do_dau',
                'ten_thanh_nguoi_do_dau')
            ->get();
        //-----------------------------------
        //------- Info Cha
        $thanh_vien_cha = $query_so_gia_dinh_id->where('chuc_vu_gd', 'Cha')->first();

        // if thanhVien's not exist in so_gia_dinh_id, we will make sure He is in so_gia_dinh_id,
        // This is a second family
        if (!$thanh_vien_cha){
            $thanh_vien_cha = $query_so_gia_dinh_id_2
                ->where('chuc_vu_gd_2', 'Cha')
                ->first();
        }
        // get BiTich of Cha
        $thanh_vien_cha_bt = $query_bi_tich->where('thanh_vien_id', $thanh_vien_cha->thanh_vien_id);

        //------- Info of Me
        $thanh_vien_me = $query_so_gia_dinh_id->where('chuc_vu_gd', 'Mẹ')->first();
        if (!$thanh_vien_me){
            $thanh_vien_me = $query_so_gia_dinh_id_2
                ->where('chuc_vu_gd_2', 'Mẹ')
                ->first();
        }
        // Get bi tich of Me
        $thanh_vien_me_bt = $query_bi_tich->where('thanh_vien_id', $thanh_vien_me ? $thanh_vien_me->thanh_vien_id : '');

        //------- Get Info and BiTich of Con
        $thanh_vien_con = DB::table('thanh_vien as tv')
            ->join('bi_tich_da_nhan as btdn', 'tv.id', '=', 'btdn.thanh_vien_id')
            ->join('tu_si as ts', 'ts.id', '=', 'btdn.tu_si_id')
            ->join('ten_thanh as tt', 'tt.id', '=', 'ts.ten_thanh_id')
            ->join('ten_thanh as t1', 't1.id', '=', 'tv.ten_thanh_id')
            ->join('bi_tich as bt', 'bt.id', '=', 'btdn.bi_tich_id')
            ->select('btdn.thanh_vien_id as thanh_vien_id',
                'ts.ho_va_ten as ten_linh_muc',
                'tv.ho_va_ten as ten_thanh_vien',
                'tv.ngay_sinh as ngay_sinh_thanh_vien',
                't1.ten_thanh as ten_thanh_thanh_vien',
                'ten_bi_tich',
                'noi_sinh',
                'tt.ten_thanh as ten_thanh_linh_muc',
                'ngay_dien_ra',
                'noi_dien_ra',
                'tv.so_gia_dinh_id',
                'tv.chuc_vu_gd',
                'ten_nguoi_do_dau',
                'ten_thanh_nguoi_do_dau')
            ->where('chuc_vu_gd', 'Con')
            ->orderBy('ten_thanh_vien', 'DESC')
            ->where('so_gia_dinh_id', $sgdcg->id)
            ->get();
        // convert to PDF
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadView('print.print_data_sgdcg',
                compact('thanh_vien_cha',
                    'thanh_vien_me',
                    'thanh_vien_cha_bt',
                    'thanh_vien_me_bt',
                    'thanh_vien_con',
                    'sgdcg'));

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->stream('SoGiaDinhCongGiao.pdf');
    }

    // crud Thanh Vien
    public function createThanhVien($sgdId){
        $all_ten_thanh  = TenThanh::all();
        // get SoGiaDinh
        $sgdcg = SoGiaDinh::find($sgdId);
        $all_tu_si = TuSi::with(['tenThanh', 'giaoXu', 'chucVu'])
            ->whereHas('chucVu', function ($q){
                $q->where('ten_chuc_vu', 'like', '%mục%');
            })->get();
        $ten_giao_xu = GiaoXu::find(Auth::user()->giao_xu_id);
        $all_bi_tich = BiTich::where('ten_bi_tich', 'Rửa tội')->get();
        return view('sgdcg.add_thanh_vien', compact('all_ten_thanh',
            'sgdcg',
               'ten_giao_xu',
               'all_bi_tich',
               'all_tu_si'));
    }

    public function storeThanhVien(Request $request, $sgdId){
        $validateData = $this->validateCreateThanhVien($request);
        $validate_biTich = $this->validateBiTich($request);
        $not_hon_nhan =  $this->validateNotHonNhan($request, $validate_biTich);
        $gx_gp = GiaoXu::with('giaoPhan')
                ->select('id', 'ten_giao_xu', 'giao_hat_id')
                ->where('id', Auth::user()->giao_xu_id)->first();
        $thanh_vien = ThanhVien::create(array_merge($validateData,
                ['nguoi_khoi_tao' => Auth::id(),
                 'giao_xu' => $gx_gp->ten_giao_xu,
                 'giao_phan' => $gx_gp->giaoPhan->ten_giao_phan,
                 'so_gia_dinh_id' => $sgdId]
        ));

        $thanh_vien->biTich()->attach($request->bi_tich_id,
            array_merge($not_hon_nhan,
                ['nguoi_khoi_tao' => Auth::id()]
        ));
        Toastr::success('Thêm mới thành công', 'Thành công');
        return redirect()->route('so-gia-dinh.editTV', ['sgdId' => $sgdId, 'tvId' => $thanh_vien->id]);
    }

    public function  editThanhVien($sgdId,$tv_id){
        $thanh_vien = ThanhVien::with('biTich')->find($tv_id);
        $sgdcg = SoGiaDinh::find($sgdId);
        $all_ten_thanh = TenThanh::all();
        $all_tu_si = TuSi::with(['tenThanh', 'giaoXu', 'chucVu'])
            ->whereHas('chucVu', function ($q){
                $q->where('ten_chuc_vu', 'like', '%mục%');
            })->get();

        $all_bi_tich = BiTich::whereDoesntHave('thanhVien', function($q) use($thanh_vien) {
            $q->where('thanh_vien_id', $thanh_vien->id);
        })->get();

        $all_bi_tich_received = BiTichDaNhan::with('tuSi.tenThanh')->where('thanh_vien_id', $tv_id)->get();
        return view('sgdcg.edit_thanh_vien', compact('all_bi_tich',
            'all_ten_thanh',
                'all_tu_si',
                'thanh_vien',
                'sgdcg',
                'all_bi_tich_received'));
    }


    public function updateThanhVien(UpdateThanhVienRequest $request, $sgdId, ThanhVien $thanh_vien){
        $validateData = $request->validated();
        // required ngay_sinh
        if (!$validateData['nam_sinh'] && !$validateData['ngay_sinh']){
            throw ValidationException::withMessages(['ngay_sinh' => 'Ngày sinh hoặc năm sinh không được phép trống']);
        }
        if ($validateData['nam_sinh'] && $validateData['ngay_sinh']){
            throw ValidationException::withMessages(['ngay_sinh' => 'Chỉ được phép nhập một trong 2 giá trị']);
        }
        if (array_key_exists('nam_sinh', $validateData) && $validateData['nam_sinh']){
            // if client input nam_sinh, it's a number and then convert to date and save it to db
            // db only receive type date
            $validateData['ngay_sinh'] =  $validateData['nam_sinh'].'/01/01';
            $thanh_vien->update(array_merge($validateData,
                ['nguoi_khoi_tao' => Auth::id()]));
        }else{
            $thanh_vien->update(array_merge($validateData,
                ['nguoi_khoi_tao' => Auth::id(),]));
        }

        Toastr::success('Cập nhập thành công', 'Thành công');
        return redirect()->route('so-gia-dinh.editTV', ['sgdId' => $sgdId, 'tvId' => $thanh_vien->id]);
    }

    public  function deleteThanhVien($sgd, $tvId){
        $thanh_vien = ThanhVien::find($tvId);
        if ($thanh_vien){
            $thanh_vien->delete();
            Toastr::success('Xóa thành công', 'Thành công');
            return redirect()->route('so-gia-dinh.show', $sgd);
        }else{
            Toastr::error('Không tìm thấy', 'Lỗi');
            return redirect()->route('so-gia-dinh.show', $sgd);
        }
    }


    // crud Bi Tich

    public function storeBiTich(Request $request, $sgdId, ThanhVien $thanh_vien){
        $validateData = $this->validateBiTich($request);
        $bi_tich = BiTich::find($request->bi_tich_id);
        $sgdcg = SoGiaDinh::with('giaoXu')->find($sgdId);
        // check BiTich HonNhan
        if ($bi_tich->la_hon_nhan == 1)
        {
            // take request and validate merge to a array, $sgdId use to check tu_si_id
            // match tu_si_id in sgdcg table because BiTICH: HonNhan must be tu_si in sgdcg promulgate
             $hon_nhan_info = $this->validateHonNhan($request, $validateData, $sgdcg);
            // create new SogiaDinh when he or she married
            $new_sgdcg = $this->createNewSGDCG($request->ngay_dien_ra);
            // update new SogiaDinh
            $thanh_vien->update([
               'so_gia_dinh_id_2' => $new_sgdcg->id,
                'chuc_vu_gd_2' => $thanh_vien->gioi_tinh ? 'Cha': 'Mẹ'
            ]);
            // update
            $thanh_vien->biTich()->attach($request->bi_tich_id,
                 array_merge($hon_nhan_info,
                     [ 'nguoi_khoi_tao' => Auth::id()]
                 ));
             Toastr::success('Cập nhập thành công', 'Thành công');
             return redirect()->route('so-gia-dinh.show', $new_sgdcg);
        }else{
            $not_hon_nhan =  $this->validateNotHonNhan($request, $validateData);
            $thanh_vien->biTich()->attach($request->bi_tich_id,
                array_merge($not_hon_nhan,
                    ['nguoi_khoi_tao' => Auth::id()]
                ));
            Toastr::success('Cập nhập thành công', 'Thành công');
            return redirect()->route('so-gia-dinh.editTV', ['sgdId' => $sgdId, 'tvId' => $thanh_vien->id]);
        }
    }

    public function  editBiTich($sgdId, ThanhVien $thanh_vien, $bi_tich_id){
        $bi_tich_detail = BiTichDaNhan::where('bi_tich_id', $bi_tich_id)
            ->where('thanh_vien_id', $thanh_vien->id)
            ->first();
        $sgdcg = SoGiaDinh::find($sgdId);
        $all_ten_thanh = TenThanh::all();
        $all_tu_si = TuSi::with(['tenThanh', 'giaoXu', 'chucVu'])
            ->whereHas('chucVu', function ($q){
                $q->where('ten_chuc_vu', 'like', '%mục%');
            })->get();

        $all_bi_tich_received = BiTichDaNhan::with('tuSi.tenThanh')
            ->where('thanh_vien_id', $thanh_vien->id)->get();

        return view('sgdcg.edit_bi_tich', compact('bi_tich_detail',
            'all_ten_thanh',
            'all_tu_si',
            'thanh_vien',
            'sgdcg',
            'all_bi_tich_received'));
    }

    public  function updateBiTich(Request $request,$sgdId, ThanhVien $thanh_vien, $bi_tich_id){
        $validateData =  $this->validate($request, [
            'noi_dien_ra' => 'required|max:150',
            'tu_si_id' => 'nullable',
            'linh_muc_ngoai' => 'nullable',
            'ngay_dien_ra' => 'required|date'
        ],[
            'noi_dien_ra.required' => 'Nơi diễn ra không được phép trống',
            'noi_dien_ra.max' => 'Nơi diễn ra không được phép vượt quá 150 ký tự',
            'tu_si_id.required' => 'Linh mục hoặc giám mục ra không được phép trống',
            'ngay_dien_ra.required' => 'Ngày diễn ra không được phép trống',
            'ngay_dien_ra.date' => 'Ngày diễn ra phải đúng dạng ngày tháng năm',
            ]
        );
        $sgdcg = SoGiaDinh::find($sgdId);
        $bi_tich_received = BiTichDaNhan::find($bi_tich_id);
        $la_hon_nhan = $bi_tich_received->getBiTich($bi_tich_received->bi_tich_id)->la_hon_nhan;
        // check to save the right data
        if ($la_hon_nhan){
            $nhan_bi_tich = $this->validateHonNhan($request, $validateData, $sgdcg);
            $bi_tich_received->update(array_merge($nhan_bi_tich,
                ['nguoi_khoi_tao' => Auth::id()]
            ));;

            Toastr::success('Cập nhập thành công', 'Thành công');
            return redirect()->route('so-gia-dinh.editBT',
                ['sgdId' => $sgdId, 'thanh_vien' => $thanh_vien, 'bi_tich_id' => $bi_tich_id]);
        }else{
            $nhan_bi_tich = $this->validateNotHonNhan($request, $validateData);
            $bi_tich_received->update(array_merge($nhan_bi_tich,
                ['nguoi_khoi_tao' => Auth::id()]
                 ));

            Toastr::success('Cập nhập thành công', 'Thành công');
            return redirect()->route('so-gia-dinh.editBT',
                ['sgdId' => $sgdId, 'thanh_vien' => $thanh_vien, 'bi_tich_id' => $bi_tich_id]);
        }

    }

    public function deleteBiTich($sgdId, ThanhVien $thanh_vien, $bi_tich_id){
        $bi_tich_received = BiTichDaNhan::find($bi_tich_id);
        if ($bi_tich_received){
           $bi_tich_received->delete();
            Toastr::success('Xóa thành công', 'Thành công');
            return redirect()->route('so-gia-dinh.editTV', ['sgdId' => $sgdId, 'tvId' => $thanh_vien->id]);
        }else{
            Toastr::error('Không tìm thấy', 'Lỗi');
            return redirect()->route('so-gia-dinh.editTV', ['sgdId' => $sgdId, 'tvId' => $thanh_vien->id]);
        }
    }
    public function fileExport(Request $request){

        if ($request->name == 'sgdcg'){
            $filepath = public_path('excels/ImportSoGiaDinh.xlsx');
        }
        if ($request->name == 'ten_thanh'){
            $filepath = public_path('excels/ImportChucVu_ViTri_TenThanh.xlsx');
        }
        if ($request->name == 'nha_dong'){
            $filepath = public_path('excels/ImportNhaDong.xlsx');
        }
        if ($request->name == 'tu_si'){
            $filepath = public_path('excels/ImportTuSi.xlsx');
        }
        if ($request->name == 'giao_phan'){
            $filepath = public_path('excels/ImportGPGHGX.xlsx');
        }
        if ($request->name == 'rua_toi_them_suc'){
            $filepath = public_path('excels/ImportThieuNhiXungToiHoacThemSuc.xlsx');
        }
        return Response::download($filepath);
    }



    // import Excel SoGiaDinh ThanhVien and BiTichDaNhan
    public function fileImport(Request $request){

        try{
            Excel::import(new BiTichDaNhanImport(), $request->file('file')->store('temp'));

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
    // import biTich XungToi ThemSuc
    public function fileImportXTTS(Request $request){

        try{
            Excel::import(new ImportBiTichXTTS(), $request->file('file')->store('temp'));
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

    // validate add BiTich for ThanhVien
    public function validateBiTich($request){
        $validateData =  $this->validate($request, [
            'bi_tich_id' => 'required',
            'noi_dien_ra' => 'required|max:150',
            'tu_si_id' => 'nullable',
            'linh_muc_ngoai' => 'nullable',
            'ngay_dien_ra' => 'required|date'
        ],[
            'bi_tich_id' => 'Bí tích không được phép trống',
            'noi_dien_ra.required' => 'Nơi diễn ra không được phép trống',
            'noi_dien_ra.max' => 'Nơi diễn ra không được phép vượt quá 150 ký tự',
            'ngay_dien_ra.required' => 'Ngày diễn ra không được phép trống',
            'ngay_dien_ra.date' => 'Ngày diễn ra phải đúng dạng ngày tháng năm',
            ]
        );
        return $validateData;
    }
    public function validateCreateThanhVien($request){
        $validateData =  $this->validate($request, [
            'ho_va_ten' => 'required|max:100',
            'ten_thanh_id' => 'nullable',
            'ngay_sinh' => 'date|nullable',
            'noi_sinh' => 'required|max:50',
            'gioi_tinh' => 'required',
            'ngay_mat' => 'date|nullable',
            'chuc_vu_gd' => 'required',
            'nam_sinh' => 'numeric|nullable',
            'dia_chi_hien_tai' => 'max:250',
            'so_dien_thoai' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ],[
            'ho_va_ten.required' => ':attribute không được phép trống',
            'ngay_sinh.date' => ':attribute phải là giá trị ngày tháng năm',
            'ngay_mat.date' => ':attribute phải là giá trị ngày tháng năm',
            'nam_sinh.numeric' => ':attribute phải là giá trị số',
            'so_dien_thoai.min' =>':attribute nhỏ hơn :min',
            'so_dien_thoai.regex' =>':attribute phải là giá trị số',
            'gioi_tinh.required' => 'Giới tính không được phép trống',
            'dia_chi_hien_tai.max' => ':attribute không vượt quá :max ký tự',
            'chuc_vu_gd.required' => 'Chức vụ trong gia đình không được trống',
            'noi_sinh.required' => 'Nơi sinh không được phép trống',
            'noi_sinh.max' => 'Nơi sinh không được vượt quá :max ký tự'
            ],
            [
            'ho_va_ten' => 'Họ và tên',
            'ngay_sinh' => 'Ngày sinh',
            'ngay_mat' => 'Ngày mất',
            'nam_sinh' => 'Năm sinh',
            'so_dien_thoai' => 'Số điện thoại',
            'dia_chi_hien_tai' => 'Địa chỉ'
            ]
        );
        if ($request->nam_sinh){
            $validateData['ngay_sinh'] =  $validateData['nam_sinh'].'/01/01';
        }
        if (!$request->nam_sinh && !$request->ngay_sinh){
            throw ValidationException::withMessages(['nam_sinh' => 'Ngày sinh không được phép trống']);
        }
        if ($request->nam_sinh && $request->ngay_sinh){
            throw ValidationException::withMessages(['nam_sinh' => 'Chỉ được phép nhập một trong 2']);
        }
        return $validateData;
    }
    public function validateHonNhan($request, $FirstValidate, $sgdcg){

        $tu_si = TuSi::find($request->tu_si_id);
        if ($tu_si->giao_xu_id !== $sgdcg->giaoXu->id){
            throw ValidationException::withMessages(['tu_si_id' => 'Linh mục phải trùng khớp trong sổ gia đình công giáo']);
        }
        $validateData = $this->validate($request, [
            'ten_nguoi_lam_chung_1' => 'required|max:100',
            'ten_thanh_nguoi_lam_chung_1' => 'required|exists:App\Models\TenThanh,ten_thanh',
            'ngay_sinh_nguoi_lam_chung_1' => 'date|nullable',
            'nam_sinh_nguoi_lam_chung_1' => 'numeric|nullable',
            'ten_nguoi_lam_chung_2'       => 'required|max:100',
            'ten_thanh_nguoi_lam_chung_2' => 'required|exists:App\Models\TenThanh,ten_thanh',
            'ngay_sinh_nguoi_lam_chung_2' => 'date|nullable',
            'nam_sinh_nguoi_lam_chung_2' => 'numeric|nullable',
        ], [
            'ten_nguoi_lam_chung_1.required' => 'Họ và tên không được phép trống',
            'ten_nguoi_lam_chung_2.required' => 'Họ và tên không được phép trống',
            'ten_nguoi_lam_chung_2.max' => 'Họ và tên không được phép vượt quá :max',
            'ten_nguoi_lam_chung_1.max' => 'Họ và tên không được phép vượt quá :max',
            'ten_thanh_nguoi_lam_chung_1.required'   => 'Tên thánh không được phép trống',
            'ten_thanh_nguoi_lam_chung_2.required'   => 'Tên thánh không được phép trống',
            'ngay_sinh_nguoi_lam_chung_1.date' => 'Ngày sinh phải là giá trị ngày tháng năm',
            'ngay_sinh_nguoi_lam_chung_2.date' => 'Ngày sinh phải là giá trị ngày tháng năm',
            'nam_sinh_nguoi_lam_chung_1.numeric'    => 'Năm sinh phải là giá trị số',
            'nam_sinh_nguoi_lam_chung_2.numeric'    => 'Năm sinh phải là giá trị số',
            'ten_thanh_nguoi_lam_chung_1.exists' => 'Không tồn tài tên thánh này',
            'ten_thanh_nguoi_lam_chung_2.exists' => 'Không tồn tài tên thánh này',
        ]);
        // required ngay_sinh or nam_sinh
        if (!$request->nam_sinh_nguoi_lam_chung_1 && !$request->ngay_sinh_nguoi_lam_chung_1){
            throw ValidationException::withMessages(['ngay_sinh_nguoi_lam_chung_1' => 'Ngày sinh không được phép trống']);
        }
        if (!$request->nam_sinh_nguoi_lam_chung_2 && !$request->ngay_sinh_nguoi_lam_chung_2){
            throw ValidationException::withMessages(['ngay_sinh_nguoi_lam_chung_1' => 'Ngày sinh không được phép trống']);
        }
        if ($request->nam_sinh_nguoi_lam_chung_1){
            $validateData['ngay_sinh_nguoi_lam_chung_1'] =  $validateData['nam_sinh_nguoi_lam_chung_1'].'/01/01';
        }
        if ($request->nam_sinh_nguoi_lam_chung_2){
            $validateData['ngay_sinh_nguoi_lam_chung_2'] =  $validateData['nam_sinh_nguoi_lam_chung_2'].'/01/01';
        }
        unset($validateData['nam_sinh_nguoi_lam_chung_1']);
        unset($validateData['nam_sinh_nguoi_lam_chung_2']);
        return array_merge($FirstValidate, $validateData);
    }

    public function validateNotHonNhan($request , $FirstValidate){
        $validateData = $this->validate($request, [
            'ten_nguoi_do_dau' => 'required|max:100',
            'ten_thanh_nguoi_do_dau' => 'required|exists:App\Models\TenThanh,ten_thanh',
            'ngay_sinh_nguoi_do_dau' => 'date|nullable',
            'nam_sinh_nguoi_do_dau' => 'numeric|nullable',

        ], [
            'ten_nguoi_do_dau.required' => 'Họ và tên không được phép trống',
            'ten_nguoi_do_dau.max' => 'Họ và tên không được phép vượt quá :max',
            'ten_thanh_nguoi_do_dau.required'   => 'Tên thánh không được phép trống',
            'ngay_sinh_nguoi_do_dau.date' => 'Ngày sinh phải là giá trị ngày tháng năm',
            'nam_sinh_nguoi_do_dau.numeric'    => 'Năm sinh phải là giá trị số',
            'ten_thanh_nguoi_do_dau.exists' => 'Không tồn tài tên thánh này',
        ]);
        // required ngay_sinh or nam_sinh
        if (!$request->ngay_sinh_nguoi_do_dau && !$request->nam_sinh_nguoi_do_dau){
            throw ValidationException::withMessages(['ngay_sinh_nguoi_do_dau' => 'Ngày sinh không được phép trống']);
        }
        // if request has nam_sinh, it will save to ngay_sinh in db and show dateformat ngay_sinh to Nam_sinh
        if ($request->nam_sinh_nguoi_do_dau){
            $validateData['ngay_sinh_nguoi_do_dau'] =  $validateData['nam_sinh_nguoi_do_dau'].'/01/01';
        }
        unset($validateData['nam_sinh_nguoi_do_dau']);
        return array_merge($FirstValidate, $validateData);
    }

    public function createNewSGDCG($ngay_dien_ra){
        $get_giao_xu = GiaoXu::with(['giaoPhan', 'giaoHat'])->where('id', Auth::user()->giao_xu_id)->first();
        $last_sgdcg = SoGiaDinh::all()->last();
        $name_GP = $this->getUpperCase($get_giao_xu->giaoPhan->ten_giao_phan);
        $name_GH = $this->getUpperCase($get_giao_xu->giaoHat->ten_giao_hat);
        $name_GX = $this->getUpperCase($get_giao_xu->ten_giao_xu);
        if ($last_sgdcg){
            $ma_so = $name_GP. '-'.$name_GH. '-'. $name_GX .'-'. ($last_sgdcg->id + 1);
        }else{
            $ma_so = $name_GP. '-'.$name_GH. '-'. $name_GX .'-'. 0;
        }
        // create so_gia_dinh
        $so_gia_dinh = SoGiaDinh::create([
            'ma_so' => $ma_so,
            'ngay_tao_so' => $ngay_dien_ra,
            'nguoi_khoi_tao' => Auth::id(),
            'giao_xu_id' => Auth::user()->giao_xu_id,
        ]);
        return $so_gia_dinh;
    }
    public function getUpperCase($name){
        preg_match_all('/[A-Z]/', $name, $matches, PREG_OFFSET_CAPTURE);
        $letter_uc = '';
        for ($i = 0 ; $i < sizeof($matches[0]); $i++){
            $letter_uc = $letter_uc . $matches[0][$i][0];
        }
        return $letter_uc;
    }
}
