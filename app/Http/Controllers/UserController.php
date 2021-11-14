<?php

namespace App\Http\Controllers;

use App\Models\GiaoPhan;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->quanTri->ten_quyen == 'admin'){
            $users = User::with(['quanTri', 'giaoXu.giaoHat', 'giaoPhan'])
                ->get();
        }elseif (Auth::user()->quanTri->ten_quyen == 'Giáo phận'){
            $users = User::with(['quanTri', 'giaoXu.giaoHat', 'giaoPhan'])
                ->whereHas('quanTri', function ($q){
                    $q->where('ten_quyen', 'Giáo phận');
                })
                ->where('giao_phan_id', Auth::user()->giao_phan_id)
                ->get();
        }else{
            $users = User::with(['quanTri', 'giaoXu.giaoHat', 'giaoPhan'])
                ->whereHas('quanTri', function ($q){
                    $q->where('ten_quyen', 'Giáo xứ');
                })
                ->where('giao_xu_id', Auth::user()->giao_xu_id)
                ->get();
        }
        return view('users.all', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validateRegister($request);
        User::create(array_merge($validateData,
            ['password'  => Hash::make($request->password),
            'quyen_quan_tri_id' => Auth::user()->quyen_quan_tri_id,
            'giao_phan_id' => Auth::user()->giao_phan_id,
            'giao_xu_id' => Auth::user()->giao_xu_id]));
        Toastr::success('Tạo tài khoản thành công','Thành công');
        return redirect()->route('tai-khoan.index');
    }


    public function validateRegister($request){
        $validateData = $request->validate([
            'ho_va_ten'      => 'required|max:45',
            'email'     => 'required|email|max:45|unique:users',
            'so_dien_thoai' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password'  => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'ho_va_ten.required' => 'Họ và tên không được phép trống',
            'ho_va_ten.max' => 'Họ và tên không được vượt quá 45 kí tự',
            'email.required' => 'Tài khoản không được phép trống',
            'email.unique' => 'Tên tài khoản đã tồn tại',
            'email.email' => 'Tài khoản phải đúng dạng email',
            'email.max' => 'Email không được vượt quá 45 kí tự',
            'password.required' => 'Mật khẩu không được phép trống',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password.min' => 'Mật khẩu không được nhỏ hơn :min',
            'password_confirmation.required' => 'Mật khẩu nhập lại không được phép trống',
            'so_dien_thoai.regex' => 'Số điện thoại phải nhập bằng số',
            'so_dien_thoai.min' => 'Độ dài số điện thoại không được nhỏ hơn :min'
        ]);
        return $validateData;
    }

    public function show($id)
    {
        $user = User::with(['giaoXu.giaoHat'])->find($id);
        $all_giao_phan = GiaoPhan::all();
        return view('users.profile', compact('user', 'all_giao_phan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user){
            return view('users.edit', compact('user'));
        }else{
            Toastr::error('Không tìm thấy','Lỗi');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $tai_khoan)
    {
        $validateData = $this->validateUpdateUser($request);
        $tai_khoan->update($validateData);
        Toastr::success('Cập nhập thành công', 'Thành công');
        return redirect()->route('tai-khoan.show', $tai_khoan->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == Auth::id()){
            Toastr::warming('Không được phép xóa tài khoản hiện tại','Cảnh báo');
            return back();
        }
        if (Auth::user()->quanTri->ten_quyen == 'admin'){
            $user = User::with(['quanTri', 'giaoXu.giaoHat', 'giaoPhan'])
                ->whereId($id)
                ->first();
        }elseif (Auth::user()->quanTri->ten_quyen == 'Giáo phận'){
            $user = User::with(['quanTri'])
                ->whereHas('quanTri', function ($q){
                    $q->where('ten_quyen', 'Giáo phận');
                })
                ->whereId($id)
                ->where('giao_phan_id', Auth::user()->giao_phan_id)
                ->first();
        }else{
            $user = User::with(['quanTri'])
                ->whereHas('quanTri', function ($q){
                    $q->where('ten_quyen', 'Giáo xứ');
                })
                ->whereId($id)
                ->where('giao_xu_id', Auth::user()->giao_xu_id)
                ->first();
        }
        if ($user){
            $user->delete();
            Toastr::success('Xóa thành công','Thành công');
            return back();
        }else{
            Toastr::error('Không tìm thấy','Lỗi');
            return back();
        }
    }

    public function validateUpdateUser($request){
        $validateData = $request->validate([
            'ho_va_ten'      => 'required|string|max:255',
            'giao_phan_id' => 'required',
            'so_dien_thoai' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|nullable',
            'giao_xu_id' => 'nullable',
        ], [
            'ho_va_ten.required' => 'Họ và tên không được phép trống',
            'giao_phan_id.required' => 'Không được phép trống',
            'so_dien_thoai.regex' => 'Số điện thoại phải là ký tự số',
            'so_dien_thoai.min' => 'Số điện thoại không được phép nhỏ hơn 10 chữ số'
        ]);
        return $validateData;
    }

    public function changePassword(Request $request){
        $request->validate([
            'password' => 'required|string|confirmed',
            'old_password' => 'required|string',
            'password_confirmation' => 'required'
        ], [
            'password.required' => 'Mật khẩu mới không được phép trống',
            'password_confirmation.required' => 'Mật khẩu nhập lại không được phép trống',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'old_password.required' => 'Mật khẩu cũ không được phép trống',
        ]);
        $password = $request->old_password;
        if(auth()->attempt(['password'=>$password, 'email' => Auth::user()->email]))
        {
            \Illuminate\Support\Facades\Auth::user()->update([
                'password' => Hash::make($password)
            ]);
            Toastr::success('Cập nhập thành công', 'Thành công');
            return redirect()->back();
        }else{
            Toastr::error('Mật khẩu cũ không đúng', 'Lỗi');
            return redirect()->back();
        }
    }
}
