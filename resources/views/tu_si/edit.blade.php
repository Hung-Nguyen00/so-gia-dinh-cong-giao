@extends('layouts.st_master')
@section('content')
    {{-- message --}}
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
                        <li class="breadcrumb-item"><a href="{{ route('tu-si.index') }}">Dánh sách tu sĩ</a></li>
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
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label">Chức vị</lable>
                                                            <select class="selectpicker form-control pt-2" name="la_tong_giam_muc">
                                                                <option selected value=""> Chọn tên chức vị</option>
                                                                <option value="T" {{ old('la_tong_giam_muc') == 'T' || $tu_si->la_tong_giam_muc == 'T'  ? 'selected' : '' }}>
                                                                    Tổng giám mục</option>
                                                                <option value="P" {{ old('la_tong_giam_muc') == 'P'|| $tu_si->la_tong_giam_muc == 'P'  ? 'selected' : '' }}>
                                                                    Giám mục phụ tá</option>
                                                                <option value="Q" {{ old('la_tong_giam_muc') == 'Q'|| $tu_si->la_tong_giam_muc == 'Q'  ? 'selected' : '' }}>
                                                                    Linh mục quản hạt</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('la_tong_giam_muc'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('la_tong_giam_muc')}}</span>
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
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label">Giới tính</lable>
                                                            <select class="selectpicker form-control pt-2" name="gioi_tinh">
                                                                <option selected value="">Chọn giới tính</option>
                                                                    <option value="1" {{ $tu_si->gioi_tinh ? 'selected' : ''}}>Nam</option>
                                                                    <option value="0" {{ $tu_si->gioi_tinh ? '' : 'selected'}}>Nữ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('gioi_tinh'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('gioi_tinh') }}</span>
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
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Tên dòng (nếu thuộc nhà dòng)</label>
                                                        <select class="selectpicker form-control pt-2"
                                                                name="nha_dong_id"
                                                                data-live-search="true" >
                                                            <option selected value="">Chọn tên nhà dòng</option>
                                                            @foreach($all_nha_dong as $cv)
                                                                <option  value="{{ $cv->id }}"
                                                                        {{ old('nha_dong_id') == $cv->id || $tu_si->nha_dong_id == $cv->id ? 'selected' : '' }}>
                                                                    {{ $cv->ten_nha_dong }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @if($errors->has('nha_dong_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('nha_dong_id') }}</span>
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
                                                            <lable class="form-label">Tổng giáo phận</lable>
                                                            <select class="selectpicker form-control pt-2" id="giao_tinh_id"
                                                                    name="giao_phan_id" data-live-search="true" >
                                                                <option selected value="">Chọn tên tổng giáo phận</option>
                                                                @foreach($all_giao_tinh as $cv)
                                                                    <option  value="{{ $cv->id }}" {{ $cv->id == old('giao_tinh_id') || $cv->id == $tu_si->giao_inh_id ? 'selected' : '' }}>
                                                                        {{ $cv->ten_giao_tinh }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Giáo phận</lable>
                                                            <select class="selectpicker form-control pt-2" id="giao_phan_id"
                                                                    value="{{ old('giao_phan_id') }}" name="giao_phan_id" data-live-search="true" >
                                                                @foreach($all_giao_phan as $cv)
                                                                    @if($cv->id === $tu_si->giao_phan_id)
                                                                        <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }} - Giáo tỉnh: {{ $cv->giaoTinh->ten_giao_tinh }} </option>
                                                                    @else
                                                                        <option {{ old('giao_phan_id') == $cv->id ? 'selected' : '' }}   value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }} - Giáo tỉnh: {{ $cv->giaoTinh->ten_giao_tinh }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('giao_phan_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('giao_phan_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mb-2 col-md-6 col-sm-12 d-flex align-items-end">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="dang_du_hoc" {{ $tu_si->dang_du_hoc ? 'checked' : '' }}
                                                                class="form-check-input ">
                                                        <label class="form-check-label">Đang du học</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-2 col-md-12 col-sm-12 mt-3">
                                                    <div id="cong_tac" class="form-group ">
                                                        <h5 class="font-weight-bold">Thông tin chuyển nơi phục vụ giáo xứ</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Giáo hạt</lable>
                                                            <select name="giao_hat_id" id="giao_hat"
                                                                    data-live-search="true"
                                                                    class="selectpicker form-control pt-2">
                                                                    <option selected value="">Chọn tên giáo hạt</option>
                                                                    @foreach($all_giao_hat as $cv)
                                                                        @if($cv->id === $tu_si->giao_hat_id)
                                                                            <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_hat }}</option>
                                                                        @elseif($cv->giao_phan_id == $tu_si->giao_phan_id)
                                                                            <option {{ old('giao_hat_id') == $cv->id ? 'selected' : '' }}  value="{{ $cv->id }}"> {{ $cv->ten_giao_hat }}</option>
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
                                                                    <option selected value="">Chọn tên giáo xứ</option>
                                                                @if($tu_si->giao_hat_id !== null)
                                                                    @foreach($all_giao_xu as $cv)
                                                                        @if($cv->id === $tu_si->giao_xu_id)
                                                                            <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                                                        @else
                                                                            <option {{ old('giao_xu_id') == $cv->id ? 'selected' : '' }}  value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
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
                                                <div class="col-lg-6 pt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <label class="form-label">Chọn phương thức lưu thông tin</label>
                                                            <select class="selectpicker form-control" value="{{ old('check_save_info') }}"
                                                                    name="check_save_info">
                                                                <option selected value=""> Chọn phương thức lưu thông tin</option>
                                                                <option value="1"> Lưu thông tin cập nhập</option>
                                                                <option value="2"> Lưu thông tin chuyển giáo xứ phục vụ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('check_save_info'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('check_save_info') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary mr-2">Lưu lại</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <form action="{{ route('tu-si.destroy', $tu_si) }}" style="margin-top: -36px;" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return window.confirm('Bạn chắc chắn muốn xóa tu sĩ này chứ?')"
                                                    class="btn btn-outline-danger d-inline-block px-3 float-right">Xóa tu sĩ</button>
                                        </form>
                                        <div style="margin-top: 50px">
                                            <hr>
                                        </div>
                                        <div class="" style="margin-top: 30px">
                                            <h4>Lịch sử phục vụ {{ $tu_si->chucVu->ten_chuc_vu }} {{ $tu_si->ho_va_ten }}</h4>
                                            @livewire('tu-si.lich-su-phuc-vu', ['tu_si' => $tu_si])
                                        </div>
                                        <div style="margin-top: 50px">
                                            <hr>
                                        </div>
                                        <div class="" style="margin-top: 30px">
                                            <h4>Lịch sử nhận chức {{ $tu_si->chucVu->ten_chuc_vu }} {{ $tu_si->ho_va_ten }}</h4>
                                            @livewire('tu-si.lich-su-nhan-chuc', ['tu_si' => $tu_si])
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