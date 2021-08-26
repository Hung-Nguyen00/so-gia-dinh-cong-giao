@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thông tin tài khoản</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thêm mới tài khoản</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div>
                                    <div class="card-header">
                                        <h4 class="card-title">Thông tin tài khoản</h4>
                                    </div>
                                    <div  class="card-body">
                                        <form action="{{ route('tai-khoan.store') }}" method="post" >
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Họ và tên</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('ho_va_ten') }}" name="ho_va_ten">
                                                        @if($errors->has('ho_va_ten'))
                                                            <span class="text-danger font-weight-bold">{{ $errors->first('ho_va_ten') }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Tên Tài khoản</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('email') }}" name="email">
                                                        @if($errors->has('email'))
                                                            <span class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Số điện thoại</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('so_dien_thoai') }}" name="so_dien_thoai">
                                                        @if($errors->has('so_dien_thoai'))
                                                            <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label><strong>Mật khẩu</strong></label>
                                                        <input type="password"
                                                               class="form-control"
                                                               name="password"
                                                               placeholder="Nhập mật khẩu">
                                                        @if($errors->has('password'))
                                                            <span class="text-danger font-weight-bold">{{ $errors->first('password') }}</span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label><strong>Nhập lại mật khẩu</strong></label>
                                                        <input type="password"
                                                               class="form-control"
                                                               name="password_confirmation"
                                                               placeholder="Nhập lại mật khẩu">
                                                        @if($errors->has('password'))
                                                            <span class="text-danger font-weight-bold">{{ $errors->first('password') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Tạo</button>
                                                </div>
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
    </div>
@endsection
