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
                        <h4>Thông tin tu sĩ</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý tu sĩ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dánh sách tu sĩ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa</a></li>
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
                                        <h4 class="card-title">Chỉnh sửa thông tin tu sĩ</h4>
                                    </div>
                                    <div  class="card-body">
                                        <form action="{{ route('add/student/save') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Họ và tên</label>
                                                        <input type="text" class="form-control @error('ho_va_ten') is-invalid @enderror"
                                                               value="{{ old('ho_va_ten') ?? $tu_si->ho_va_ten }}" name="ho_va_ten">
                                                        @error('ho_va_ten')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Tên thánh</lable>
                                                            <select class="selectpicker form-control pt-2" name="ten_thanh_id" data-live-search="true" >
                                                                @foreach($all_ten_thanh as $cv)
                                                                    @if($cv->id === $tu_si->ten_thanh_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_thanh }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_thanh }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('ten_thanh_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Chức vụ</lable>
                                                            <select class="selectpicker form-control pt-2" name="chuc_vu_id" data-live-search="true" >
                                                                @foreach($all_chuc_vu as $cv)
                                                                    @if($cv->id === $tu_si->chuc_vu_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('chuc_vu_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Ngày nhận chức</label>
                                                        <input type="date" class="form-control @error('ngay_nhan_chuc') is-invalid @enderror"
                                                               value="{{ old('ngay_nhan_chuc') ?? $tu_si->ngay_nhan_chuc }}"
                                                               name="ngay_nhan_chuc"
                                                        >
                                                        @error('ngay_nhan_chuc')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Nơi nhận chức</label>
                                                        <input type="text" class="form-control @error('noi_nhan_chuc') is-invalid @enderror"
                                                               value="{{ old('noi_nhan_chuc') ?? $tu_si->noi_nhan_chuc }}"
                                                               name="noi_nhan_chuc"
                                                        >
                                                        @error('noi_nhan_chuc')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Ngày sinh</label>
                                                        <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror"
                                                               value="{{ old('ngay_sinh') ?? $tu_si->ngay_sinh }}"
                                                               name="ngay_sinh"
                                                               >
                                                        @error('ngay_sinh')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Ngày mất</label>
                                                        <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror"
                                                               value="{{ old('ngay_sinh') ?? $tu_si->ngay_mat }}"
                                                               name="ngay_sinh"
                                                               >
                                                        @error('ngay_sinh')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Số điện thoại</label>
                                                        <input type="tel" class="form-control @error('mobileNumber') is-invalid @enderror"
                                                               value="{{ old('so_dien_thoai') ?? $tu_si->so_dien_thoai }}" name="so_dien_thoai">
                                                        @error('so_dien_thoai')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                       </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Địa chỉ</label>
                                                        <input type="text" class="form-control @error('parentsName') is-invalid @enderror"
                                                               value="{{ old('dia_chi') ?? $tu_si->dia_chi }}" name="dia_chi">
                                                        @error('so_dien_thoai')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                       </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Giáo phận</lable>
                                                            <select class="selectpicker form-control pt-2" name="giao_phan_id" data-live-search="true" >
                                                                @foreach($all_giao_phan as $cv)
                                                                    @if($cv->id === $tu_si->giao_phan_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('giao_phan_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Giáo hạt</lable>
                                                            <select class="selectpicker form-control pt-2" name="giao_hat_id" data-live-search="true" >
                                                                @foreach($all_giao_hat as $cv)
                                                                    @if($cv->id === $tu_si->giao_hat_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_hat }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_hat }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('giao_hat_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Giáo Xứ</lable>
                                                            <select class="selectpicker form-control pt-2" name="giao_xu_id" data-live-search="true" >
                                                                @foreach($all_giao_xu as $cv)
                                                                    @if($cv->id === $tu_si->giao_xu_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('giao_xu_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="submit" class="btn btn-light">Hủy</button>
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