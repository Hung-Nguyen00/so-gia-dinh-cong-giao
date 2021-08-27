@extends('layouts.st_master')
{{-- @section('menu')
@extends('sidebar.dashboard')
@endsection --}}
@section('content')
    <div class="content-body">
        <!-- row -->
        {!! Toastr::message() !!}
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thống kê giáo xứ {{ $giao_xu->ten_giao_xu }}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Thống kê giáo xứ {{ $giao_xu->ten_giao_xu }}</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media">
                                 <span class="mr-3">
                                    <i class="la la-home"></i>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Số lượng giáo họ</p>
                                    <h4 class="mb-0">{{ $giao_xu->giao_ho_count }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                 <span class="mr-3">
                                   <i class="la la-users"></i>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Số lượng <br> kết hôn</p>
                                    <h4 class="mb-0">{{ $static_ket_hon }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                <span class="mr-3">
                                  <i class="la la-graduation-cap"></i>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Số lượng <br> sinh</p>
                                    <h4 class="mb-0">{{ $static_sinh }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                 <span class="mr-3">
                                  <i class="la la-diamond"></i>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Số lượng <br> tử</p>
                                    <h4 class="mb-0" >{{ $static_tu }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-7 col-lg-7 col-xxl-7 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thông tin giáo phận</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 700px;">
                                    <thead>
                                    <tr>
                                        <th width="25">STT</th>
                                        <th width="50">Tên giáo họ</th>
                                        <th width="100">Địa chỉ</th>
                                        <th width="50">Năm thành lập</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i = 0; @endphp
                                    @if($giao_xu->giaoHo->count() > 0)
                                    @foreach($giao_xu->giaoHo as $th)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $th->ten_giao_xu }}</td>
                                            <td>{{ $th->dia_chi }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($th->ngay_thanh_lap)->format('Y')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-xxl-5 h-50 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thông tin giáo xứ {{ $giao_xu->ten_giao_xu }}</h4>
                        </div>
                        <div class="student-info">
                            <div class="table-responsive info-table">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Giám mục:</td>
                                        <td class="font-medium  text-break text-dark-medium">
                                            {{ $linh_muc->tenThanh->ten_thanh }} {{ $linh_muc->ho_va_ten }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nhà thờ chính tòa</td>
                                        <td class="font-medium text-break text-dark-medium">
                                            {{ $giao_xu->ten_giao_xu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td class="font-medium text-break text-dark-medium">
                                            {{ $giao_xu->dia_chi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng linh mục</td>
                                        <td class="font-medium text-dark-medium"> {{ $giao_xu->tu_si_count }}</td>
                                    </tr>
                                    <tr>
                                        <td>Năm thành lập</td>
                                        <td class="font-medium text-dark-medium">
                                            {{ \Carbon\Carbon::parse($giao_xu->ngay_thanh_lap)->format('Y') }}
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
@endsection