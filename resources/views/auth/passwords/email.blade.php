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
                                <h4 class="text-center mb-4">Quên mật khẩu</h4>
                                <p class="auth-subtitle mb-3">Nhập email của bạn, hệ thống sẽ gửi mật khẩu qua gmail</p>
                                @if (session('message'))
                                    <div class="text-success text-center" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <form method="POST" action="/forget-password">
                                    @csrf
                                    <div class="form-group">
                                        <label><strong>Email</strong></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}"
                                               placeholder="Nhập email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Gửi</button>
                                    </div>
                                    <div class="text-center mt-3 text-lg fs-4">
                                        <p class='text-gray-600'>Bạn vẫn nhớ mật khẩu? <a href="{{ route('login') }}" class="font-bold">Đăng nhập</a>.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection