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
                                        <form action="{{ route('giaoXu.updateTuDong', $tu_si)}}" method="post" >
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
                                                                        <option  value="{{ $cv->id }}" {{ old('ten_thanh_id') == $cv->id ? 'selected' : '' }} > {{ $cv->ten_thanh }}</option>
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
                                                                        <option  value="{{ $cv->id }}" {{ old('chuc_vu_id') == $cv->id ? 'selected' : '' }} > {{ $cv->ten_chuc_vu }}</option>
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
                                                        <label class="form-label ">Email</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('email') ?? $tu_si->email }}"
                                                               name="email"
                                                        >
                                                    </div>
                                                    @if($errors->has('email'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Tên dòng</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('ten_dong') ?? $tu_si->ten_dong}}" name="ten_dong">
                                                    </div>
                                                    @if($errors->has('ten_dong'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ten_dong') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label">Vị trí phục vụ giáo xứ</lable>
                                                            <select class="selectpicker form-control pt-2" value="{{ old('vi_tri_id') }}"
                                                                    data-live-search="true"
                                                                    name="vi_tri_id">
                                                                <option selected value="">Chọn tên vị trí phục vụ của giáo xứ</option>
                                                                @foreach($all_vi_tri as $cv)
                                                                    @if($cv->id === $tu_si->vi_tri_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_vi_tri }}</option>
                                                                    @else
                                                                        <option {{ old('vi_tri_id') == $cv->id ? 'selected' : '' }}   value="{{ $cv->id }}"> {{ $cv->ten_vi_tri }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
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

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary mr-2">Lưu lại</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <form action="{{ route('giaoXu.deleteTuDong', $tu_si) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return window.confirm('Bạn chắc chắn muốn xóa tu sĩ này chứ?')"
                                                class="btn btn-danger float-right" style="margin-top: -56px">Xóa tu sĩ</button>
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


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var url = $(location).attr("origin");
            $('#giao_phan_id').change(function () {
                var id = $(this).val();
                console.log(id);
                $('#giao_hat').find('option').not(':first').remove();
                $.ajax({
                    url: url+'/tu-si/giao-hat/'+id,
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
                    url: url+'/tu-si/giao-xu/'+id,
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
        });

    </script>
@endsection