@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    @include('tu_si.import')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Tài khoản</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Gửi thông báo</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-4">
                                            <h4 class="font-weight-bold">Gửi thông báo đến các Giáo Xứ</h4>
                                            <a href="{{ route('user.history-email') }}" class="btn btn-primary btn-sm">Lịch sử gửi email</a>
                                        </div>

                                        <form action="{{ route('user.post-send-email') }}" method="post" role="form" class="col-md-12 col-lg-12">
                                            {{ csrf_field() }}
                                            <div class="col-md-6 col-lg-6 p-0 pr-2 float-left pb-3">
                                                <div class="controls">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="form_email">Tiêu đề</label>
                                                                <input id="form_email" name="title" class="form-control"
                                                                       value="{{ old('title') }}"
                                                                       placeholder="Nhập tiêu đề">
                                                                <div class="help-block with-errors"></div>
                                                                @if($errors->has('title'))
                                                                    <span class="text-danger pt-2 font-weight-bold">{{ $errors->first('title') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="form_message">Nội dung</label>
                                                                <textarea id="form_message" name="content"
                                                                          class="form-control ckeditor"
                                                                          placeholder="Nhập nội dung" rows="6"
                                                                >{{ old('content') }}</textarea>
                                                                @if($errors->has('content'))
                                                                    <span class="text-danger pt-2 font-weight-bold">{{ $errors->first('content') }}</span>
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12">
                                                            <input type="submit" class="btn btn-success btn-send"
                                                                   value="Gửi thông báo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive col-md-6 border pb-3 col-lg-6 pt-3">
                                                <table class="table " id="example3">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10px">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                       id="all">
                                                                <label class="custom-control-label" for="all">Tất
                                                                    cả</label>
                                                            </div>
                                                        </th>
                                                        <th style="width: 120px">Tên Giáo Hạt</th>
                                                        <th style="width: 80px">Tên Giáo Xứ</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($gxs)
                                                        @php $i = 0; @endphp
                                                        @foreach($gxs as $gx)
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="custom-control-input"
                                                                           name="gx[]"
                                                                           value="{{ $gx->id }}"
                                                                           id="{{$gx->id}}">
                                                                    <label class="custom-control-label"
                                                                           for="{{ $gx->id }}">{{ ++$i }}</label>
                                                                </div>
                                                            </td>
                                                            <td>{{ $gx->giaoHat->ten_giao_hat }}</td>
                                                            <td>{{ $gx->ten_giao_xu }}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
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

@push('scripts')
    <script>
    $(function () {
        $("#all").click(function () {
            $("input[name='gx[]']").attr("checked", this.checked);
        });
    });
    </script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endpush