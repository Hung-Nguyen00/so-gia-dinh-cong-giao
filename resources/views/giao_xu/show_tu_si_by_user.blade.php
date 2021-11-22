@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    @include('tu_si.import')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles d-flex justify-content-between flex-wrap mx-0">
                <div class="col-sm-3 p-md-0 d-flex align-items-center">
                    <div class="welcome-text ">
                        <h4>Các tu sĩ</h4>
                    </div>
                </div>
                <div class="col-sm-5 p-md-0">
                    <div class="welcome-text text-center text-primary">
                        <h5 class="text-primary font-weight-bold">Thống kê số lượng</h5>
                        <span>Linh mục: <strong>{{ $count_linh_muc }}</strong></span>
                        <span>| Thầy: <strong>{{ $count_chung_sinh }}</strong></span>
                        <span>| Sơ: <strong>{{ $count_so }}</strong></span>
                    </div>
                </div>
                <div class="col-sm-4 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý giáo xứ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Tu sĩ</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        @livewire('giao-xu.show-tu-si-by-giao-xu')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection