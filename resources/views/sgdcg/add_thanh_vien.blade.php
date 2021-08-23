@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-4 p-md-0">
                    <div class="welcome-text">
                        <h4>Thêm thành viên vào sổ {{ $sgdcg->ma_so }}</h4>
                    </div>
                </div>
                <div class="col-sm-8 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý giáo xứ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Sổ gia đình công giáo</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thêm thành viên</a></li>
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
                                        <h4 class="card-title">Thông tin thành viên</h4>
                                    </div>
                                    <div  class="card-body">
                                        <form action="{{ route('so-gia-dinh.storeTV', $sgdcg->id ) }}" method="post" >
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize" style="margin-bottom: 7px;">Họ và tên</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('ho_va_ten') }}" name="ho_va_ten">
                                                    </div>
                                                    @if($errors->has('ho_va_ten'))
                                                        <span class="text-danger  font-weight-bold">{{ $errors->first('ho_va_ten') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Tên thánh</lable>
                                                            <select class="selectpicker  form-control pt-2" name="ten_thanh_id" data-live-search="true" >
                                                                <option selected value=""> Chọn tên thánh</option>
                                                                @foreach($all_ten_thanh as $cv)
                                                                    <option  value="{{ $cv->id }}" {{ old('ten_thanh_id') == $cv->id ? 'selected' : '' }}> {{ $cv->ten_thanh }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('ten_thanh_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_id') }}</span>
                                                    @endif
                                                </div>
                                                    <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                        <label>Ngày sinh</label>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <input type="date" value="{{ old('ngay_sinh')}}" name="ngay_sinh" class="form-control col-md-5">
                                                            <label >Hoặc nhập năm:</label>
                                                            <input type="number" value="{{ old('nam_sinh')}}"  name="nam_sinh" class="form-control col-md-3">
                                                        </div>
                                                        @if($errors->has('ngay_sinh'))
                                                            <span class="text-danger">{{ $errors->first('ngay_sinh') }}</span>
                                                        @endif
                                                        @if($errors->has('nam_sinh'))
                                                            <span class="text-danger">{{ $errors->first('nam_sinh') }}</span>
                                                        @endif
                                                    </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Ngày mất</label>
                                                        <input type="date" class="form-control "
                                                               value="{{ old('ngay_mat')}}"
                                                               name="ngay_mat"
                                                        >
                                                    </div>
                                                    @if($errors->has('ngay_mat'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ngay_mat') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Số điện thoại</label>
                                                        <input type="tel" class="form-control "
                                                               value="{{ old('so_dien_thoai')}}" name="so_dien_thoai">
                                                    </div>
                                                    @if($errors->has('so_dien_thoai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Địa chỉ</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('dia_chi_hien_tai')}}" name="dia_chi_hien_tai">
                                                    </div>
                                                    @if($errors->has('dia_chi_hien_tai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('dia_chi_hien_tai') }}</span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                                    <a class="btn btn-light"
                                                       href="{{ route('so-gia-dinh.show', $sgdcg)  }}">Quay lại
                                                    </a>
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

