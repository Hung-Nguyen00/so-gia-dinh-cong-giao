<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\QuyenQuanTri;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register()
    {
        $all_giao_phan = GiaoPhan::all();
        $all_giao_hat = GiaoHat::all();
        $all_giao_xu = GiaoXu::where('giao_xu_hoac_giao_ho',0)->get();
        $all_quyen_han = QuyenQuanTri::all();
        return view('auth.register', compact('all_quyen_han',
            'all_giao_phan', 'all_giao_hat', $all_giao_xu));
    }
    public function storeUser(Request $request)
    {
        $validateData = $this->validateRegister($request);
        User::create(array_merge($validateData, ['password'  => Hash::make($request->password)]));
        Toastr::success('Tạo tài khoản thành công','Thành công');
        return redirect()->route('tai-khoan.index');
    }


    public function validateRegister($request){
        $validateData = $request->validate([
            'ho_va_ten'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:100|unique:users',
            'quyen_quan_tri_id' => 'required',
            'giao_phan_id' => 'required',
            'giao_xu_id' => 'nullable',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'ho_va_ten.required' => 'Họ và tên không được phép trống',
            'email.required' => 'Tài khoản không được phép trống',
            'email.email' => 'Tài khoản phải đúng dạng email ví dụ: abc@gmail.com',
            'email.unique' => 'Tài khoản đã tồn tại',
            'email.max' => 'Tài khoản không được vượt quá 100 ký tự',
            'quyen_quan_tri_id.required' => 'Quyền hạn không được phép trống',
            'password.required' => 'Mật khẩu không được phép trống',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'giao_phan_id.required' => 'Không được phép trống',
        ]);
        $name_role = QuyenQuanTri::find($request->quyen_quan_tri_id);
        if ($name_role->ten_quyen === 'Giáo xứ' && !$request->giao_xu_id){
            throw  ValidationException::withMessages(['giao_xu_id' => 'Giáo xứ không được phép trống khi quyền hạn là Giáo xứ']);
        }
        if ($name_role->ten_quyen === 'Giáo phận' && $request->giao_xu_id){
            throw  ValidationException::withMessages(['giao_xu_id' => 'Giáo xứ sẽ không được chọn khi quyền hạn là Giáo phận']);
        }

        return $validateData;
    }
}
