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
                        <h4>Chỉnh sửa thành viên</h4>
                    </div>
                </div>
                <div class="col-sm-8 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý giáo xứ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Sổ gia đình công giáo</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa thành viên</a></li>
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
                                        <form action="{{ route('so-gia-dinh.updateTV', ['sgdId' => $sgdcg->id, 'thanh_vien' => $thanh_vien])}}" method="post" >
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize" style="margin-bottom: 7px;">Họ và tên</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('ho_va_ten') ?? $thanh_vien->ho_va_ten}}" name="ho_va_ten">
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
                                                                    <option  value="{{ $cv->id }}" {{ old('ten_thanh_id') || $thanh_vien->ten_thanh_id == $cv->id ? 'selected' : '' }}> {{ $cv->ten_thanh }}</option>
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
                                                        @if(\Carbon\Carbon::parse($thanh_vien->ngay_sinh)->format('d-m') == '01-01' && strtotime($thanh_vien->ngay_sinh) < strtotime(1980))
                                                            <input type="date" value="{{ old('ngay_sinh')}}" name="ngay_sinh" class="form-control col-md-5">
                                                            <label >Hoặc nhập năm:</label>
                                                            <input type="number"
                                                                   value="{{ old('nam_sinh') ?? \Carbon\Carbon::parse($thanh_vien->ngay_sinh)->format('Y')}}"
                                                                   name="nam_sinh"
                                                                   class="form-control col-md-3">
                                                        @else
                                                            <input type="date" value="{{ old('ngay_sinh') ?? $thanh_vien->ngay_sinh}}" name="ngay_sinh" class="form-control col-md-5">
                                                            <label >Hoặc nhập năm:</label>
                                                            <input type="number"
                                                                   value="{{ old('nam_sinh')}}"
                                                                   name="nam_sinh"
                                                                   class="form-control col-md-3">
                                                        @endif
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
                                                               value="{{ old('ngay_mat') ?? $thanh_vien->ngay_mat}}"
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
                                                               value="{{ old('so_dien_thoai') ?? $thanh_vien->so_dien_thoai}}" name="so_dien_thoai">
                                                    </div>
                                                    @if($errors->has('so_dien_thoai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Địa chỉ</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('dia_chi_hien_tai') ?? $thanh_vien->dia_chi_hien_tai }}" name="dia_chi_hien_tai">
                                                    </div>
                                                    @if($errors->has('dia_chi_hien_tai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('dia_chi_hien_tai') }}</span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                                                    <a class="btn btn-light"
                                                       href="{{ route('so-gia-dinh.editTV', ['sgdId' => $sgdcg->id, 'tvId' => $thanh_vien->id])  }}">Quay lại
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <form action="{{ route('so-gia-dinh.updateBT', ['sgdId' => $sgdcg->id, 'thanh_vien' => $thanh_vien, 'bi_tich_id' => $bi_tich_detail->id] ) }}" method="post" >
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <h4><strong>Thông tin bí tích {{ $bi_tich_detail->getBiTich($bi_tich_detail->bi_tich_id)->ten_bi_tich }}</strong></h4>
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Tên linh mục hoặc giám mục</lable>
                                                            <select class="selectpicker  form-control pt-2" name="tu_si_id" id="tu_si" data-live-search="true" >
                                                                @foreach($all_tu_si as $cv)
                                                                    @if($cv->id == $bi_tich_detail->tu_si_id)
                                                                        <option  value="{{ $cv->id }}" selected>
                                                                            {{ $cv->giaoXu->ten_giao_xu.': '. $cv->tenThanh->ten_thanh .' '. $cv->ho_va_ten }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"
                                                                                {{ old('tu_si_id') == $cv->id ? 'selected' : '' }}>
                                                                            {{ $cv->giaoXu->ten_giao_xu.': '. $cv->tenThanh->ten_thanh .' '. $cv->ho_va_ten }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('tu_si_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('tu_si_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize" style="margin-bottom: 7px;">Ngày diễn ra</label>
                                                        <input type="date" class="form-control"
                                                               value="{{ old('ngay_dien_ra') ?? $bi_tich_detail->ngay_dien_ra }}" name="ngay_dien_ra">
                                                    </div>
                                                    @if($errors->has('ngay_dien_ra'))
                                                        <span class="text-danger  font-weight-bold">{{ $errors->first('ngay_dien_ra') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Nơi diễn ra</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('noi_dien_ra') ?? $bi_tich_detail->noi_dien_ra }}" name="noi_dien_ra">
                                                    </div>
                                                    @if($errors->has('noi_dien_ra'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('noi_dien_ra') }}</span>
                                                    @endif
                                                </div>
                                                @if($bi_tich_detail->getBiTich($bi_tich_detail->bi_tich_id)->la_hon_nhan)
                                                    <div id="hon_nhan" class="mt-2 col-md-12 d-flex flex-wrap col-sm-12">
                                                        <div class="col-md-12  col-sm-12">
                                                            <h5><strong>Thông tin người làm chứng 1</strong></h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label text-capitalize">Họ và tên</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{ old('ten_nguoi_lam_chung_1') ?? $bi_tich_detail->ten_nguoi_lam_chung_1 }}" name="ten_nguoi_lam_chung_1">
                                                            </div>
                                                            @if($errors->has('ten_nguoi_lam_chung_1'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ten_nguoi_lam_chung_1')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <div>
                                                                    <lable class="form-label text-capitalize">Tên thánh</lable>
                                                                    <select class="selectpicker  form-control pt-2" name="ten_thanh_nguoi_lam_chung_1" data-live-search="true" >
                                                                        <option selected value=""> Chọn tên thánh</option>
                                                                        @foreach($all_ten_thanh as $cv)
                                                                            <option  value="{{ $cv->ten_thanh }}"
                                                                                    {{ old('ten_thanh_nguoi_lam_chung_1') || $bi_tich_detail->ten_thanh_nguoi_lam_chung_1 == $cv->ten_thanh ? 'selected' : '' }}>
                                                                                {{ $cv->ten_thanh }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @if($errors->has('ten_thanh_nguoi_lam_chung_1'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_nguoi_lam_chung_1') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                            <label>Ngày sinh</label>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                @if(\Carbon\Carbon::parse($bi_tich_detail->ngay_sinh_nguoi_lam_chung_1)->format('d-m') == '01-01' && strtotime($bi_tich_detail->ngay_sinh_nguoi_lam_chung_1) < strtotime(1980))
                                                                    <input type="date" value="{{ old('ngay_sinh_nguoi_lam_chung_1')}}"
                                                                           name="ngay_sinh_nguoi_lam_chung_1"
                                                                           class="form-control col-md-5">
                                                                    <label >Hoặc nhập năm:</label>
                                                                    <input type="number"
                                                                           value="{{ old('nam_sinh_nguoi_lam_chung_1') ?? \Carbon\Carbon::parse($bi_tich_detail->ngay_sinh_nguoi_lam_chung_1)->format('Y')}}"
                                                                           name="nam_sinh_nguoi_lam_chung_1"
                                                                           class="form-control col-md-3">
                                                                @else
                                                                    <input type="date" value="{{ old('ngay_sinh_nguoi_lam_chung_1') ?? $bi_tich_detail->ngay_sinh_nguoi_lam_chung_1 }}"
                                                                           name="ngay_sinh_nguoi_lam_chung_1"
                                                                           class="form-control col-md-5">
                                                                    <label >Hoặc nhập năm:</label>
                                                                    <input type="number"
                                                                           value="{{ old('nam_sinh_nguoi_lam_chung_1') }}"
                                                                           name="nam_sinh_nguoi_lam_chung_1"
                                                                           class="form-control col-md-3">
                                                                @endif

                                                            </div>
                                                            @if($errors->has('ngay_sinh_nguoi_lam_chung_1'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ngay_sinh_nguoi_lam_chung_1') }}</span>
                                                            @endif
                                                            @if($errors->has('nam_sinh_nguoi_lam_chung_1'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('nam_sinh_nguoi_lam_chung_1') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-12 mt-4 col-sm-12">
                                                            <h5><strong>Thông tin người làm chứng 2</strong></h5>
                                                        </div>
                                                        <div class="col-lg-6  col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label text-capitalize">Họ và tên</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{ old('ten_nguoi_lam_chung_2') ?? $bi_tich_detail->ten_nguoi_lam_chung_2 }}" name="ten_nguoi_lam_chung_2">
                                                            </div>
                                                            @if($errors->has('ten_nguoi_lam_chung_2'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ten_nguoi_lam_chung_2')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <div>
                                                                    <lable class="form-label text-capitalize">Tên thánh</lable>
                                                                    <select class="selectpicker  form-control pt-2" name="ten_thanh_nguoi_lam_chung_2" data-live-search="true" >
                                                                        <option selected value=""> Chọn tên thánh</option>
                                                                        @foreach($all_ten_thanh as $cv)
                                                                            <option  value="{{ $cv->ten_thanh }}"
                                                                                    {{ old('ten_thanh_nguoi_lam_chung_2') || $bi_tich_detail->ten_thanh_nguoi_lam_chung_2 == $cv->ten_thanh ? 'selected' : '' }}>
                                                                                {{ $cv->ten_thanh }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @if($errors->has('ten_thanh_nguoi_lam_chung_2'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_nguoi_lam_chung_2') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                            <label>Ngày sinh</label>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                @if(\Carbon\Carbon::parse($bi_tich_detail->ngay_sinh_nguoi_lam_chung_2)->format('d-m') == '01-01' && strtotime($bi_tich_detail->ngay_sinh_nguoi_lam_chung_2) < strtotime(1980))
                                                                    <input type="date" value="{{ old('ngay_sinh_nguoi_lam_chung_2')}}"
                                                                           name="ngay_sinh_nguoi_lam_chung_2"
                                                                           class="form-control col-md-5">
                                                                    <label >Hoặc nhập năm:</label>
                                                                    <input type="number"
                                                                           value="{{ old('nam_sinh_nguoi_lam_chung_2') ?? \Carbon\Carbon::parse($bi_tich_detail->ngay_sinh_nguoi_lam_chung_2)->format('Y') }}"
                                                                           name="nam_sinh_nguoi_lam_chung_2"
                                                                           class="form-control col-md-3">
                                                                @else
                                                                    <input type="date" value="{{ old('ngay_sinh_nguoi_lam_chung_2') ?? $bi_tich_detail->ngay_sinh_nguoi_lam_chung_2}}"
                                                                           name="ngay_sinh_nguoi_lam_chung_2"
                                                                           class="form-control col-md-5">
                                                                    <label >Hoặc nhập năm:</label>
                                                                    <input type="number"
                                                                           value="{{ old('nam_sinh_nguoi_lam_chung_2') }}"
                                                                           name="nam_sinh_nguoi_lam_chung_2"
                                                                           class="form-control col-md-3">
                                                                @endif

                                                            </div>
                                                            @if($errors->has('ngay_sinh_nguoi_lam_chung_2'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ngay_sinh_nguoi_lam_chung_2') }}</span>
                                                            @endif
                                                            @if($errors->has('nam_sinh_nguoi_lam_chung_2'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('nam_sinh_nguoi_lam_chung_2') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <div id="them_suc" class=" mt-2 col-md-12 d-flex flex-wrap col-sm-12" >
                                                        <div class="col-md-12 col-sm-12">
                                                            <h5><strong> Thông tin người đỡ đầu </strong></h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label text-capitalize">Họ và tên</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{ old('ten_nguoi_do_dau') ?? $bi_tich_detail->ten_nguoi_do_dau }}" name="ten_nguoi_do_dau">
                                                            </div>
                                                            @if($errors->has('ten_nguoi_do_dau'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ten_nguoi_do_dau')}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <div>
                                                                    <lable class="form-label text-capitalize">Tên thánh</lable>
                                                                    <select class="selectpicker  form-control pt-2" name="ten_thanh_nguoi_do_dau" data-live-search="true" >
                                                                        <option selected value=""> Chọn tên thánh</option>
                                                                        @foreach($all_ten_thanh as $cv)
                                                                            <option  value="{{ $cv->ten_thanh }}"
                                                                                    {{ old('ten_thanh_nguoi_do_dau') || $bi_tich_detail->ten_thanh_nguoi_do_dau == $cv->ten_thanh ? 'selected' : '' }}>
                                                                                {{ $cv->ten_thanh }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @if($errors->has('ten_thanh_nguoi_do_dau'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_nguoi_do_dau') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                            <label>Ngày sinh</label>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                @if(\Carbon\Carbon::parse($bi_tich_detail->ngay_sinh_nguoi_do_dau)->format('d-m') == '01-01' && strtotime($bi_tich_detail->ngay_sinh_nguoi_do_dau) < strtotime(1980))
                                                                <input type="date" value="{{ old('ngay_sinh_nguoi_do_dau') }}"
                                                                       name="ngay_sinh_nguoi_do_dau"
                                                                       class="form-control col-md-5">
                                                                <label >Hoặc nhập năm:</label>
                                                                <input type="number"
                                                                       value="{{ old('nam_sinh_nguoi_do_dau') ?? \Carbon\Carbon::parse($bi_tich_detail->ngay_sinh_nguoi_do_dau)->format('Y')}}"
                                                                       name="nam_sinh_nguoi_do_dau"
                                                                       class="form-control col-md-3">
                                                                    @else
                                                                <input type="date" value="{{ old('ngay_sinh_nguoi_do_dau') ?? $bi_tich_detail->ngay_sinh_nguoi_do_dau }}"
                                                                       name="ngay_sinh_nguoi_do_dau"
                                                                       class="form-control col-md-5">
                                                                <label >Hoặc nhập năm:</label>
                                                                <input type="number"
                                                                       value="{{ old('nam_sinh_nguoi_do_dau') }}"
                                                                       name="nam_sinh_nguoi_do_dau"
                                                                       class="form-control col-md-3">
                                                                @endif
                                                            </div>
                                                            @if($errors->has('ngay_sinh_nguoi_do_dau'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('ngay_sinh_nguoi_do_dau') }}</span>
                                                            @endif
                                                            @if($errors->has('nam_sinh'))
                                                                <span class="text-danger font-weight-bold">{{ $errors->first('nam_sinh_nguoi_do_dau') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-lg-12 mt-4 col-md-12 col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                                                    <a class="btn btn-light"
                                                       href="{{ route('so-gia-dinh.editTV', ['sgdId' => $sgdcg->id, 'tvId' => $thanh_vien->id])  }}">Quay lại
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <div class="mt-2 col-lg-12 col-md-12 col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                                            <h4>Các bí tích đã nhận</h4>
                                            <div class="table-responsive">
                                                <table id="example3" class="display" style="min-width: 845px">
                                                    <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Tên bí tích</th>
                                                        <th>Ngày nhận</th>
                                                        <th>Nơi nhận</th>
                                                        <th>Linh mục truyền chức</th>
                                                        <th>Xem chi tiết</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody >
                                                    @php $i= 0; @endphp
                                                    @foreach($all_bi_tich_received as $th)
                                                        <tr >
                                                            <td class="text-center"> {{ ++$i }}</td>
                                                            <td> {{ $th->getBiTich($th->bi_tich_id)->ten_bi_tich }}</td>
                                                            <td>
                                                                {{ \Carbon\Carbon::parse($th->ngay_dien_ra)->format('d-m-Y') }}
                                                            </td>
                                                            <td>
                                                                {{ $th->noi_dien_ra }}
                                                            </td>
                                                            <td>
                                                                {{ $th->tuSi->tenThanh->ten_thanh .' '. $th->tuSi->ho_va_ten}}
                                                            </td>
                                                            <td class="text-center d-flex justify-content-center">
                                                                @if($th->id == $bi_tich_detail->id)
                                                                    <form action=" {{ route('so-gia-dinh.deleteBT', ['sgdId' => $sgdcg->id, 'thanh_vien' => $thanh_vien, 'bi_tich_id' => $th->id] ) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                                onclick="return window.confirm('Bạn chắc chắn muốn xóa bí tích này chứ?')"
                                                                                class="btn btn-sm btn-danger mr-2 "><i class="text-white la la-trash-o"></i></button>
                                                                    </form>

                                                                @else
                                                                    <a type="button"
                                                                       href="{{ route('so-gia-dinh.editBT',
                                                                       ['sgdId' => $sgdcg->id, 'thanh_vien' => $thanh_vien, 'bi_tich_id' => $th->id])}}"
                                                                       class="btn btn-sm btn-primary mb-1 mr-2"
                                                                    >
                                                                        <i class="la la-pencil"></i>
                                                                    </a>
                                                                    <form action=" {{ route('so-gia-dinh.deleteBT', ['sgdId' => $sgdcg->id, 'thanh_vien' => $thanh_vien, 'bi_tich_id' => $th->id] ) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                           onclick="return window.confirm('Bạn chắc chắn muốn xóa bí tích này chứ?')"
                                                                           class="btn btn-sm btn-danger mr-2 "><i class="text-white la la-trash-o"></i></button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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


@section('scripts')
    <script>
        document.onload = changeForm();
        function changeForm() {
            var x = document.getElementById("bi_tich"),
                hon_nhan = document.getElementById('hon_nhan'),
                then_suc = document.getElementById('them_suc');
            console.log(then_suc);
            var text = x.options[x.selectedIndex].text;
            if(text.toLocaleLowerCase().indexOf('hôn') > -1){
                hon_nhan.classList.remove('d-lg-none', 'd-sm-none');
                then_suc.classList.add('d-lg-none', 'd-sm-none');
            }else{
                hon_nhan.classList.add('d-lg-none', 'd-sm-none');
                then_suc.classList.remove('d-lg-none', 'd-sm-none');
            }
        }
    </script>
@endsection