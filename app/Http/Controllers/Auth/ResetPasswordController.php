<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Hash;

class ResetPasswordController extends Controller
{
    public function getPassword($token) {
       return view('auth.passwords.reset', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ],[
            'email.required' => 'Tài khoản không được phép trống',
            'email.exists' => 'Tài khoản không tồn tại',
            'password.required' => 'Mật khẩu không được phép trống',
            'password_confirmation.required' => 'Mật khẩu nhập lại không được phép trống',
            'password.confirmed' => 'Mật khẩu nhập lại không trùng khớp',
            'password.min' => 'Mật khẩu không được nhỏ hơn :min',
            ]
         );

        $updatePassword = DB::table('password_resets')
                            ->where(['email' => $request->email, 'token' => $request->token])
                            ->first();

        if(!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
