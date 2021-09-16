@extends('layouts.st_master')
@section('content')
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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thông tin tài khoản</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane d-flex flex-wrap fade active show col-lg-12">
                           <div class="col-md-8 col-sm-12 col-xs-12">
                               <div class="card ">
                                   <div class="card-header">
                                       <h4 class="font-weight-bold">Thông tin tài khoản</h4>
                                   </div>
                                   <div  class="card-body">
                                       <form action="{{ route('tai-khoan.update', ['tai_khoan' => $user]) }}" method="post" >
                                           @csrf
                                           @method('PATCH')
                                           <div class="row d-flex flex-wrap">
                                               <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                   <div class="form-group">
                                                       <label class="form-label ">Họ và tên</label>
                                                       <input type="text" class="form-control"
                                                              value="{{ old('ho_va_ten') ?? $user->ho_va_ten }}" name="ho_va_ten">
                                                   </div>
                                                   @if($errors->has('ho_va_ten'))
                                                       <span class="text-danger font-weight-bold">{{ $errors->first('ho_va_ten') }}</span>
                                                   @endif
                                               </div>
                                               <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                   <div class="form-group">
                                                       <label class="form-label ">Email</label>
                                                       <input type="text" class="form-control"
                                                              value="{{ old('email') ?? $user->email }}" name="email">
                                                   </div>
                                                   @if($errors->has('email'))
                                                       <span class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                                                   @endif
                                               </div>
                                               <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                   <div class="form-group">
                                                       <label class="form-label ">Số điện thoại</label>
                                                       <input type="text" class="form-control"
                                                              value="{{ old('so_dien_thoai') ?? $user->so_dien_thoai }}" name="so_dien_thoai">
                                                   </div>
                                                   @if($errors->has('so_dien_thoai'))
                                                       <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
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
                                                                           {{ old('giao_phan_id') == $cv->id || $user->giao_phan_id == $cv->id ? 'selected' : '' }}>
                                                                       {{ $cv->ten_giao_phan }} - Giáo Tỉnh: {{ $cv->giaoTinh->ten_giao_tinh }}</option>
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
                                                               @if($user->giaoXu)
                                                                   @if($user->giaoXu->giaoHat)
                                                                       <option selected value="{{ $user->giaoXu->giaoHat->id }}">
                                                                           {{ $user->giaoXu->giaoHat->ten_giao_hat }}
                                                                       </option>
                                                                   @else
                                                                       <option selected value=""> Chọn tên giáo hạt</option>
                                                                   @endif
                                                               @endif
                                                           </select>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                   <div class="form-group ">
                                                       <div>
                                                           <lable class="form-label ">Giáo Xứ</lable>
                                                           <select class="selectpicker form-control pt-2" value="{{ old('giao_xu_id') }}"
                                                                   data-live-search="true"
                                                                   id="giao_xu"
                                                                   name="giao_xu_id">
                                                               @if($user->giaoXu)
                                                                   <option value="{{ $user->giao_xu_id }}" selected> {{ $user->giaoXu->ten_giao_xu }}</option>
                                                               @else
                                                                   <option value="" selected>Chọn giáo xứ</option>
                                                               @endif
                                                           </select>
                                                       </div>
                                                   </div>
                                                   @if($errors->has('giao_xu_id'))
                                                       <span class="text-danger font-weight-bold">{{ $errors->first('giao_xu_id') }}</span>
                                                   @endif
                                               </div>
                                               <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                   <button type="submit" class="btn btn-primary">Lưu lại</button>
                                               </div>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="font-weight-bold">Đổi mật khẩu</h4>
                                    </div>
                                    <div  class="card-body">
                                    <form action="{{ route('changePassword', ['tai_khoan' => $user]) }}" method="post" >
                                        @csrf
                                        @method('PATCH')
                                        <div class="row d-flex flex-column">
                                            <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label ">Mật khẩu cũ</label>
                                                    <input type="password" class="form-control"
                                                           value="" name="old_password">
                                                </div>
                                                @if($errors->has('old_password'))
                                                    <span class="text-danger font-weight-bold">{{ $errors->first('old_password') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label ">Mật khẩu mới</label>
                                                    <input type="password" class="form-control"
                                                           value="{{ old('password')}}" name="password">
                                                </div>
                                                @if($errors->has('password'))
                                                    <span class="text-danger font-weight-bold">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label ">Nhập lại mật khẩu mới</label>
                                                    <input type="password" class="form-control"
                                                           value="{{ old('password')}}" name="password_confirmation">
                                                </div>
                                                @if($errors->has('password'))
                                                    <span class="text-danger font-weight-bold">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                                                <button type="submit" class="btn btn-primary">Lưu lại</button>
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


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var url = $(location).attr("origin");
            $('#giao_phan_id').change(function () {
                var id = $(this).val();
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
                $('#giao_xu').find('option').remove();
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
            $('#giao_xu').change(function () {
                var id = $(this).val();
                console.log(id);
                $('#giao_ho').find('option').remove();
                $.ajax({
                    url:   url+'/tu-si/giao-ho/'+id,
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

