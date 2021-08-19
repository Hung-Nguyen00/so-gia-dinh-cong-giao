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
                                        <form action="{{ route('tu-si.update', $tu_si)}}" method="post" >
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Họ và tên</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('ho_va_ten') ?? $tu_si->ho_va_ten}}" name="ho_va_ten">
                                                    </div>
                                                    @if($errors->has('ho_va_ten'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ho_va_ten') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <lable class="form-label ">Tên thánh</lable>
                                                            <select class="selectpicker  form-control pt-2" value="{{ old('ten_thanh_id')}}" name="ten_thanh_id" data-live-search="true" >
                                                                @foreach($all_ten_thanh as $cv)
                                                                    @if($cv->id === $tu_si->ten_thanh_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_thanh }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_thanh }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('ten_thanh_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Chức vụ</lable>
                                                            <select class="selectpicker  form-control pt-2"  value="{{ old('chuc_vu_id') }}" name="chuc_vu_id" data-live-search="true" >
                                                                @foreach($all_chuc_vu as $cv)
                                                                    @if($cv->id === $tu_si->chuc_vu_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('chuc_vu_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Ngày nhận chức</label>
                                                        <input type="date" class="form-control"
                                                               value="{{ old('ngay_nhan_chuc') ?? $tu_si->ngay_nhan_chuc  }}"
                                                               name="ngay_nhan_chuc"
                                                        >
                                                    </div>
                                                    @if($errors->has('ngay_nhan_chuc'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ngay_nhan_chuc') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Nơi nhận chức</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('noi_nhan_chuc') ?? $tu_si->noi_nhan_chuc }}"
                                                               name="noi_nhan_chuc"
                                                        >
                                                    </div>
                                                    @if($errors->has('noi_nhan_chuc'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('noi_nhan_chuc') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Ngày sinh</label>
                                                        <input type="date" class="form-control "
                                                               value="{{ old('ngay_sinh') ?? $tu_si->ngay_sinh }}"
                                                               name="ngay_sinh"
                                                        >
                                                    </div>
                                                    @if($errors->has('ngay_sinh'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ngay_sinh') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Ngày mất</label>
                                                        <input type="date" class="form-control "
                                                               value="{{ old('ngay_mat') ?? $tu_si->ngay_mat }}"
                                                               name="ngay_mat"
                                                        >
                                                    </div>
                                                    @if($errors->has('ngay_mat'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ngay_mat') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Số điện thoại</label>
                                                        <input type="tel" class="form-control "
                                                               value="{{ old('so_dien_thoai') ?? $tu_si->so_dien_thoai }}" name="so_dien_thoai">
                                                    </div>
                                                    @if($errors->has('so_dien_thoai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Địa chỉ</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('dia_chi_hien_tai') ?? $tu_si->dia_chi_hien_tai }} " name="dia_chi_hien_tai">
                                                    </div>
                                                    @if($errors->has('dia_chi_hien_tai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('dia_chi_hien_tai') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Giáo phận</lable>
                                                            <select class="selectpicker form-control pt-2" id="giao_phan_id"
                                                                    value="{{ old('giao_phan_id') }}" name="giao_phan_id" data-live-search="true" >
                                                                @foreach($all_giao_phan as $cv)
                                                                    @if($cv->id === $tu_si->giao_phan_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('giao_phan_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('giao_phan_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Giáo hạt</lable>
                                                            <select name="giao_hat_id" id="giao_hat"
                                                                    data-live-search="true"
                                                                    class="selectpicker form-control pt-2">
                                                                    @if($tu_si->giao_hat_id == null)
                                                                        <option selected value="">Chọn tên giáo xứ</option>
                                                                    @endif
                                                                    @foreach($all_giao_hat as $cv)
                                                                    @if($cv->id === $tu_si->giao_hat_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_hat }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_hat }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Giáo xứ</lable>
                                                            <select class="selectpicker form-control pt-2" value="{{ old('giao_xu_id') }}"
                                                                    data-live-search="true"
                                                                    id="giao_xu"
                                                                    name="giao_xu_id">
                                                                @if($tu_si->giao_xu_id == null)
                                                                    <option selected value="">Chọn tên giáo xứ</option>
                                                                @endif
                                                                @foreach($all_giao_xu as $cv)
                                                                    @if($cv->id === $tu_si->giao_xu_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label">Giáo họ</lable>
                                                            <select class="selectpicker form-control pt-2" value="{{ old('giao_ho_id') }}"
                                                                    data-live-search="true"
                                                                    id="giao_ho"
                                                                    name="giao_ho_id">
                                                                @if($tu_si->giao_xu_hoac_giao_ho == 0)
                                                                    <option selected value="">Chọn tên giáo họ</option>
                                                                @endif
                                                                @foreach($all_giao_ho as $cv)
                                                                    @if($cv->id === $tu_si->giao_xu_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                                                    @else
                                                                        <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Ngày bắt đầu phục vụ giáo xứ mới</label>
                                                        <input type="date" class="form-control "
                                                               value="{{ old('bat_dau_phuc_vu') ?? $tu_si->bat_dau_phuc_vu }}"
                                                               name="bat_dau_phuc_vu"
                                                        >
                                                    </div>
                                                    @if($errors->has('bat_dau_phuc_vu'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('bat_dau_phuc_vu') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Ngày kết thúc giáo xứ đã phục vụ</label>
                                                        <input type="date" class="form-control "
                                                               value="{{ old('ket_thuc_phuc_vu') ?? $tu_si->ket_thuc_phuc_vu }}"
                                                               name="ket_thuc_phuc_vu"
                                                        >
                                                    </div>
                                                    @if($errors->has('ket_thuc_phuc_vu'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ket_thuc_phuc_vu') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                    <button type="submit" class="btn btn-primary mr-2">Lưu lại thông tin cập nhập</button>
                                                    <button type="submit" class="btn btn-primary mr-2">Lưu thông tin chuyển giáo xứ</button>
                                                    <a href="{{ route('tu-si.search', ['chuc_vu_id' => 1]) }}" class="btn btn-light">Quay lại</a>
                                                </div>
                                            </div>
                                        </form>
                                        <table class="table verticle-middle table-responsive-md">
                                            <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Assigned Professor</th>
                                                <th scope="col">Date Of Admit</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Fees</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>Jack Ronan</td>
                                                <td>Airi Satou</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge badge-rounded badge-primary">Checkin</span></td>
                                                <td>Commerce</td>
                                                <td>120$</td>
                                                <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>02 </td>
                                                <td>Jimmy Morris</td>
                                                <td>Angelica Ramos</td>
                                                <td>31 July 2020</td>
                                                <td><span class="badge badge-rounded badge-warning">Panding</span></td>
                                                <td>Mechanical</td>
                                                <td>120$</td>
                                                <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>03 </td>
                                                <td>Nashid Martines</td>
                                                <td>Ashton Cox</td>
                                                <td>30 July 2020</td>
                                                <td><span class="badge badge-rounded badge-danger">Canceled</span></td>
                                                <td>Science</td>
                                                <td>520$</td>
                                                <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
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
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#giao_phan_id').change(function () {
                var id = $(this).val();
                console.log(id);
                $('#giao_hat').find('option').not(':first').remove();
                $.ajax({
                    url:'giao-hat/'+id,
                    type:'get',
                    dataType:'json',
                    success:function (response) {
                        console.log(response.data);
                        var len = 0;
                        if (response.data != null) {
                            len = response.data.length;
                        }
                        if (len>0) {
                            for (var i = 0; i<len; i++) {
                                var id = response.data[i].id;
                                var name = response.data[i].ten_giao_hat;
                                var option = "<option value='"+id+"'>"+name+"</option>";
                                $("#giao_hat").append(option);
                            }
                        }
                        $('#giao_hat').selectpicker('refresh');
                    }
                })
            });
            $('#giao_hat').change(function () {
                var id = $(this).val();
                console.log(id);
                $('#giao_xu').find('option').not(':first').remove();
                $.ajax({
                    url:'giao-xu/'+id,
                    type:'get',
                    dataType:'json',
                    success:function (response) {
                        console.log(response.data);
                        var len = 0;
                        if (response.data != null) {
                            len = response.data.length;
                        }
                        if (len>0) {
                            for (var i = 0; i<len; i++) {
                                var id = response.data[i].id;
                                var name = response.data[i].ten_giao_xu;
                                var option = "<option value='"+id+"'>"+name+"</option>";
                                $("#giao_xu").append(option);
                            }
                        }
                        $('#giao_xu').selectpicker('refresh');
                    }
                })
            });
            $('#giao_xu').change(function () {
                var id = $(this).val();
                console.log(id);
                $('#giao_ho').find('option').not(':first').remove();
                $.ajax({
                    url:'giao-ho/'+id,
                    type:'get',
                    dataType:'json',
                    success:function (response) {
                        console.log(response.data);
                        var len = 0;
                        if (response.data != null) {
                            len = response.data.length;
                        }
                        if (len>0) {
                            for (var i = 0; i<len; i++) {
                                var id = response.data[i].id;
                                var name = response.data[i].ten_giao_xu;
                                var option = "<option value='"+id+"'>"+name+"</option>";
                                $("#giao_ho").append(option);
                            }
                        }
                        $('#giao_ho').selectpicker('refresh');
                    }
                })
            });
        });

    </script>
@endsection