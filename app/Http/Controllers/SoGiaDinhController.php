<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateThanhVienRequest;
use App\Models\BiTich;
use App\Models\BiTichDaNhan;
use App\Models\GiaoXu;
use App\Models\SoGiaDinh;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SoGiaDinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get value match GiaoXu because Account has role which is GiaoXU and then only see it's data
        $all_so_gia_dinh = SoGiaDinh::withCount('thanhVien')
            ->where('giao_xu_id', Auth::user()->giao_xu_id)->get();

        $ten_giao_xu = GiaoXu::where('id', Auth::user()->giao_xu_id)->first()->ten_giao_xu;
        return view('sgdcg.all', compact('all_so_gia_dinh', 'ten_giao_xu'));
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


    public function indexThanhVien($id){

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
     * @param  \App\Models\SoGiaDinh  $soGiaDinh
     * @return \Illuminate\Http\Response
     */
    public function show(SoGiaDinh $soGiaDinh)
    {
        $all_thanh_vien = ThanhVien::with(['tenThanh'])->withCount('biTich')
            ->where('so_gia_dinh_id', $soGiaDinh->id)->get();
        return view('sgdcg.thanh_vien', compact('all_thanh_vien', 'soGiaDinh'));
    }

    public function createThanhVien($sgdId){
        $all_ten_thanh  = TenThanh::all();
        // get SoGiaDinh
        $sgdcg = SoGiaDinh::find($sgdId);
        return view('sgdcg.add_thanh_vien', compact('all_ten_thanh', 'sgdcg'));
    }

    public function storeThanhVien(CreateThanhVienRequest $request, $sgdId){
        $validateData = $request->validated();
        if (array_key_exists('nam_sinh', $validateData )){
            // if client input nam_sinh, it's a number and then convert to date and save it to db
            // db only receive type date
            $validateData['ngay_sinh'] =  $validateData['nam_sinh'].'/01/01';
            ThanhVien::create(array_merge($validateData,
                ['nguoi_khoi_tao' => Auth::id(),
                  'so_gia_dinh_id' => $sgdId]));
        }else{
            ThanhVien::create(array_merge($validateData,
                ['nguoi_khoi_tao' => Auth::id(),
                    'so_gia_dinh_id' => $sgdId]));
        }
        Toastr::success('Thêm mới thành công', 'success');
        return redirect()->route('so-gia-dinh.show', SoGiaDinh::find($sgdId));
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


    public function updateThanhVien(CreateThanhVienRequest $request, $sgdId, ThanhVien $thanh_vien){
        $validateData = $request->validated();
        // required ngay_sinh
        if (!$validateData['nam_sinh'] && $validateData['ngay_sinh']){
            throw ValidationException::withMessages(['ngay_sinh' => 'Ngày sinh hoặc năm sinh không được phép trống']);
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

        Toastr::success('Cập nhập thành công', 'success');
        return redirect()->route('so-gia-dinh.editTV', ['sgdId' => $sgdId, 'tvId' => $thanh_vien->id]);
    }

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
             $thanh_vien->biTich()->attach($request->bi_tich_id, [
                 'ngay_dien_ra' => $hon_nhan_info['ngay_dien_ra'],
                 'noi_dien_ra'  => $hon_nhan_info['noi_dien_ra'],
                 'ten_nguoi_lam_chung_1'  => $hon_nhan_info['ten_nguoi_lam_chung_1'],
                 'ten_thanh_nguoi_lam_chung_1' => $hon_nhan_info['ten_thanh_nguoi_lam_chung_1'],
                 'ngay_sinh_nguoi_lam_chung_1'=> $hon_nhan_info['ngay_sinh_nguoi_lam_chung_1'],
                 'ten_nguoi_lam_chung_2'    => $hon_nhan_info['ten_nguoi_lam_chung_2'],
                 'ten_thanh_nguoi_lam_chung_2' => $hon_nhan_info['ten_thanh_nguoi_lam_chung_2'],
                 'ngay_sinh_nguoi_lam_chung_2' => $hon_nhan_info['ngay_sinh_nguoi_lam_chung_2'] ,
                 'nguoi_khoi_tao' => Auth::id(),
                 'tu_si_id'  => $hon_nhan_info['tu_si_id'],
             ]);
             Toastr::success('Cập nhập thành công', 'success');
             return redirect()->route('so-gia-dinh.editTV', ['sgdId' => $sgdId, 'tvId' => $thanh_vien->id]);
        }else{
            $this->validateNotHonNhan($request, $validateData);
        }
    }

    public function  editBiTich($sgdId, ThanhVien $thanh_vien, $bi_tich_id){
        $thanh_vien = ThanhVien::with('biTich')->first();
        $bi_tich_detail = BiTichDaNhan::find($bi_tich_id);
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
    public function edit(SoGiaDinh $soGiaDinh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SoGiaDinh  $soGiaDinh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoGiaDinh $soGiaDinh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SoGiaDinh  $soGiaDinh
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoGiaDinh $soGiaDinh)
    {
        //
    }

    public  function validateBiTich($request){
        $validateData =  $this->validate($request, [
            'bi_tich_id' => 'required',
            'noi_dien_ra' => 'required|max:150',
            'tu_si_id' => 'required',
            'ngay_dien_ra' => 'required|date'
        ],[
            'bi_tich_id' => 'Bí tích không được phép trống',
            'noi_dien_ra.required' => 'Nơi diễn ra không được phép trống',
            'noi_dien_ra.max' => 'Nơi diễn ra không được phép vượt quá 150 ký tự',
            'tu_si_id.required' => 'Linh mục hoặc giám mục ra không được phép trống',
            'ngay_dien_ra.required' => 'Ngày diễn ra không được phép trống',
            'ngay_dien_ra.date' => 'Ngày diễn ra phải đúng dạng ngày tháng năm',
            ]
        );
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
        return array_merge($FirstValidate, $validateData);
    }

    public function validateNotHonNhan($request , $FirstValidate){
        $validateData = $this->validate($request, [
            'ten_nguoi_do_dau' => 'required|max:100',
            'ten_thanh_nguoi_do_dau' => 'required|exists:App\Models\TenThanh,id',
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
            throw ValidationException::withMessages(['ngay_sinh_nguoi_lam_chung_1' => 'Ngày sinh không được phép trống']);
        }
        // if request has nam_sinh, it will save to ngay_sinh in db and show dateformat ngay_sinh to Nam_sinh
        if ($request->nam_sinh_nguoi_do_dau){
            $validateData['ngay_sinh_nguoi_do_dau'] =  $validateData['nam_sinh_nguoi_do_dau'].'/01/01';
        }
        return array_merge($FirstValidate, $validateData);
    }
}
