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
                {{--<div class="col-sm-5 p-md-0">--}}
                    {{--<div class="welcome-text text-center text-primary">--}}
                        {{--<h5 class="text-primary font-weight-bold">Thống kê số lượng theo ngành</h5>--}}
                        {{--<span>Chiên non: <strong>{{ $count_chien_non }}</strong></span>--}}
                        {{--<span>| Ấu nhi: <strong>{{ $count_au_nhi }}</strong></span>--}}
                        {{--<span>| Thiếu Nhi: <strong>{{ $count_thieu_nhi }}</strong></span>--}}
                        {{--<span>| Nghĩa sĩ: <strong>{{ $count_nghia_si }}</strong></span>--}}
                        {{--<span>| Hiệp sĩ: <strong>{{ $count_hiep_si }}</strong></span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="col-sm-4 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thiếu nhi và ca đoàn</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thiếu nhi</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-panel col-lg-12">
                            <div class="card">
                                @livewire('giao-xu.thieu-nhi')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection