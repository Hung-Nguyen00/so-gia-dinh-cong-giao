<?php

namespace App\Http\Controllers;

use App\Models\QuyenQuanTri;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                ->where('giao_phan_id', Auth::user()->giao_phan_id)
                ->get();
        }else{
            $users = User::with(['quanTri', 'giaoXu.giaoHat', 'giaoPhan'])
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
        return back();
    }


    public function validateRegister($request){
        $validateData = $request->validate([
            'ho_va_ten'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'so_dien_thoai' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'ho_va_ten.required' => 'Họ và tên không được phép trống',
            'email.required' => 'Tài khoản không được phép trống',
            'password.required' => 'Mật khẩu không được phép trống',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'so_dien_thoai.regex' => 'Số điện thoại phải nhập bằng số',
            'so_dien_thoai.min' => 'Độ dài số điện thoại không được nhỏ hơn :min'
        ]);
        return $validateData;
    }

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
        $user = User::find($id);
        if ($user){
            $user->delete();
            Toastr::success('Xóa thành công','Thành công');
            return back();
        }else{
            Toastr::error('Không tìm thấy','Lỗi');
            return back();
        }
    }
}
