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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý tu sĩ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tu-si.index') }}">Dánh sách tu sĩ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thêm mới tu sĩ</a></li>
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
                                        <h4 class="card-title">Thông tin tu sĩ</h4>
                                    </div>
                                    <div  class="card-body">
                                        <form action="{{ route('tu-si.store') }}" method="post" >
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <lable class="form-label ">Tên thánh</lable>
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
                                                    <div class="form-group">
                                                        <label class="form-label ">Họ và tên</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('ho_va_ten') }}" name="ho_va_ten">
                                                    </div>
                                                    @if($errors->has('ho_va_ten'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ho_va_ten') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Chức vụ</lable>
                                                            <select class="selectpicker  form-control pt-2"   name="chuc_vu_id" data-live-search="true" >
                                                                <option selected value=""> Chọn tên chức vụ</option>
                                                                @foreach($all_chuc_vu as $cv)
                                                                    <option  value="{{ $cv->id }}" {{ old('chuc_vu_id') == $cv->id ? 'selected' : '' }}> {{ $cv->ten_chuc_vu }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('chuc_vu_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('chuc_vu_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label">Chức vị</lable>
                                                            <select class="selectpicker form-control pt-2" name="la_tong_giam_muc">
                                                                <option selected value=""> Chọn tên chức vị</option>
                                                                <option value="T" {{ old('la_tong_giam_muc') == 'T' ? 'selected' : '' }}>Tổng giám mục</option>
                                                                <option value="P" {{ old('la_tong_giam_muc') == 'P' ? 'selected' : '' }}>Giám mục phụ tá</option>
                                                                <option value="Q" {{ old('la_tong_giam_muc') == 'Q' ? 'selected' : '' }}>Cha quản hạt</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('la_tong_giam_muc'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('la_tong_giam_muc')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Giới tính</lable>
                                                            <select class="selectpicker form-control pt-2" name="gioi_tinh">
                                                                <option value="0" {{ old('gioi_tinh') == 0 ? 'selected' : '' }}>Nữ</option>
                                                                <option selected value="1" {{ old('gioi_tinh') == 1 ? 'selected' : '' }}>Nam</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('gioi_tinh'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('gioi_tinh') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Email</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('email') }}"
                                                               name="email"
                                                        >
                                                    </div>
                                                    @if($errors->has('email'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Ngày nhận chức</label>
                                                        <input type="date" class="form-control"
                                                               value="{{ old('ngay_nhan_chuc')  }}"
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
                                                               value="{{ old('noi_nhan_chuc') }}"
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
                                                                        {{ old('nha_dong_id') == $cv->id ? 'selected' : '' }}>
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
                                                               value="{{ old('ngay_sinh')}}"
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
                                                        <label class="form-label ">Số điện thoại</label>
                                                        <input type="tel" class="form-control "
                                                               value="{{ old('so_dien_thoai')}}" name="so_dien_thoai">
                                                    </div>
                                                    @if($errors->has('so_dien_thoai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label ">Địa chỉ</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('dia_chi_hien_tai')}}" name="dia_chi_hien_tai">
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
                                                                    name="giao_phan_id" data-live-search="true" >
                                                                <option selected value="">Chọn tên giáo phận</option>
                                                                @foreach($all_giao_phan as $cv)
                                                                    <option  value="{{ $cv->id }}"
                                                                    {{ old('giao_phan_id') || \Auth::user()->giao_phan_id == $cv->id ? 'selected' : '' }}>
                                                                        Giáo Tỉnh: {{ $cv->giaoTinh->ten_giao_tinh }} - GP: {{ $cv->ten_giao_phan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('giao_phan_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('giao_phan_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                    <div class="form-check ml-1">
                                                        <input type="checkbox" name="dang_du_hoc" class="form-check-input">
                                                        <label class="form-check-label">Đang du học</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-3 col-md-12 col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Thêm</button>
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


{{--@section('scripts')--}}
    {{--<script type="text/javascript">--}}
        {{--$( window ).on( "load", function() {--}}
            {{--var id = $('#giao_phan_id').val();--}}
            {{--console.log(id);--}}
            {{--$('#giao_hat').find('option').not(':first').remove();--}}
            {{--$.ajax({--}}
                {{--url:'giao-hat/'+id,--}}
                {{--type:'get',--}}
                {{--dataType:'json',--}}
                {{--success:function (response) {--}}
                    {{--console.log(response.data);--}}
                    {{--var len = 0;--}}
                    {{--if (response.data != null) {--}}
                        {{--len = response.data.length;--}}
                    {{--}--}}
                    {{--if (len>0) {--}}
                        {{--for (var i = 0; i<len; i++) {--}}
                            {{--var id = response.data[i].id;--}}
                            {{--var name = response.data[i].ten_giao_hat;--}}
                            {{--var option = "<option value='"+id+"'>"+name+"</option>";--}}
                            {{--$("#giao_hat").append(option);--}}
                        {{--}--}}
                    {{--}--}}
                    {{--$('#giao_hat').selectpicker('refresh');--}}
                {{--}--}}
            {{--})--}}
        {{--});--}}
        {{--$(document).ready(function () {--}}
            {{--$('#giao_phan_id').change(function () {--}}
                {{--var id = $(this).val();--}}
                {{--console.log(id);--}}
                {{--$('#giao_hat').find('option').not(':first').remove();--}}
                {{--$.ajax({--}}
                    {{--url:'giao-hat/'+id,--}}
                    {{--type:'get',--}}
                    {{--dataType:'json',--}}
                    {{--success:function (response) {--}}
                        {{--console.log(response.data);--}}
                        {{--var len = 0;--}}
                        {{--if (response.data != null) {--}}
                            {{--len = response.data.length;--}}
                        {{--}--}}
                        {{--if (len>0) {--}}
                            {{--for (var i = 0; i<len; i++) {--}}
                                {{--var id = response.data[i].id;--}}
                                {{--var name = response.data[i].ten_giao_hat;--}}
                                {{--var option = "<option value='"+id+"'>"+name+"</option>";--}}
                                {{--$("#giao_hat").append(option);--}}
                            {{--}--}}
                        {{--}--}}
                        {{--$('#giao_hat').selectpicker('refresh');--}}
                    {{--}--}}
                {{--})--}}
            {{--});--}}
            {{--$('#giao_hat').change(function () {--}}
                {{--var id = $(this).val();--}}
                {{--console.log(id);--}}
                {{--$('#giao_xu').find('option').not(':first').remove();--}}
                {{--$.ajax({--}}
                    {{--url:'giao-xu/'+id,--}}
                    {{--type:'get',--}}
                    {{--dataType:'json',--}}
                    {{--success:function (response) {--}}
                        {{--console.log(response.data);--}}
                        {{--var len = 0;--}}
                        {{--if (response.data != null) {--}}
                            {{--len = response.data.length;--}}
                        {{--}--}}
                        {{--if (len>0) {--}}
                            {{--for (var i = 0; i<len; i++) {--}}
                                {{--var id = response.data[i].id;--}}
                                {{--var name = response.data[i].ten_giao_xu;--}}
                                {{--var option = "<option value='"+id+"'>"+name+"</option>";--}}
                                {{--$("#giao_xu").append(option);--}}
                            {{--}--}}
                        {{--}--}}
                        {{--$('#giao_xu').selectpicker('refresh');--}}
                    {{--}--}}
                {{--})--}}
            {{--});--}}
            {{--$('#giao_xu').change(function () {--}}
                {{--var id = $(this).val();--}}
                {{--console.log(id);--}}
                {{--$('#giao_ho').find('option').not(':first').remove();--}}
                {{--$.ajax({--}}
                    {{--url:'giao-ho/'+id,--}}
                    {{--type:'get',--}}
                    {{--dataType:'json',--}}
                    {{--success:function (response) {--}}
                        {{--console.log(response.data);--}}
                        {{--var len = 0;--}}
                        {{--if (response.data != null) {--}}
                            {{--len = response.data.length;--}}
                        {{--}--}}
                        {{--if (len>0) {--}}
                            {{--for (var i = 0; i<len; i++) {--}}
                                {{--var id = response.data[i].id;--}}
                                {{--var name = response.data[i].ten_giao_xu;--}}
                                {{--var option = "<option value='"+id+"'>"+name+"</option>";--}}
                                {{--$("#giao_ho").append(option);--}}
                            {{--}--}}
                        {{--}--}}
                        {{--$('#giao_ho').selectpicker('refresh');--}}
                    {{--}--}}
                {{--})--}}
            {{--});--}}
        {{--});--}}

    {{--</script>--}}
{{--@endsection--}}