@extends('layouts.app')
@section('content')
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Lấy lại mật khẩu</h4>
                                    <form method="POST" action="/reset-password">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Mật khẩu</strong></label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   placeholder="Nhập mật khẩu">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Nhập lại mật khẩu</strong></label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Thay đổi mật khẩu</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Bạn đã có tài khoản <a class="text-primary" href="{{ route('login') }}">Đăng nhập</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection