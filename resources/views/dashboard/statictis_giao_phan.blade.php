@extends('layouts.st_master')
{{-- @section('menu')
@extends('sidebar.dashboard')
@endsection --}}
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thống kê giáo phận</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Thống kê giáo phận</a></li>
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
                                    <p class="mb-1">Số lượng giáo hạt</p>
                                    <h4 class="mb-0">{{ $statistics_giao_phan->giao_hat_count }}</h4>
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
                                    <p class="mb-1">Số lượng <br> linh mục</p>
                                    <h4 class="mb-0">{{ $linh_muc_count }}</h4>
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
                                    <p class="mb-1">Số lượng chủng sinh</p>
                                    <h4 class="mb-0">{{ $chung_sinh_count }}</h4>
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
                                    <p class="mb-1">Tổng số <br> giáo dân</p>
                                    <h4 class="mb-0" >{{ $statistics_giao_phan->giao_dan_count }}</h4>
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
                                <table id="example" class="display" style="min-width: 500px;">
                                    <thead>
                                        <tr>
                                            <th width="25">STT</th>
                                            <th width="100">Tên giáo hạt</th>
                                            <th width="50">Số lượng giáo xứ</th>
                                            <th width="50">Số lượng giáo dân</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i = 0; @endphp
                                    @if($statistics_giao_phan->giaoHat->count() > 0)
                                        @foreach($statistics_giao_phan->giaoHat as $th)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $th->ten_giao_hat }}</td>
                                            <td class="text-center">{{ $th->giaoXu->count() }}</td>
                                            <td class="text-center">{{ $th->giaoDan->count() }}</td>
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
                            <h4>Thông tin giáo phận</h4>
                        </div>
                        <div class="student-info">
                            <div class="table-responsive info-table">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Giám mục:</td>
                                        <td class="font-medium  text-break text-dark-medium">
                                                {{ $giam_muc->tenThanh->ten_thanh }} {{ $giam_muc->ho_va_ten }}
                                      </td>
                                    </tr>
                                    <tr>
                                        <td>Nhà thờ chính tòa</td>
                                        <td class="font-medium text-break text-dark-medium">
                                            {{ $statistics_giao_phan->ten_nha_tho }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td class="font-medium text-break text-dark-medium">
                                            {{ $statistics_giao_phan->dia_chi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng linh mục</td>
                                        <td class="font-medium text-dark-medium"> {{ $linh_muc_count }}</td>
                                    </tr>
                                    <tr>
                                        <td>Năm thành lập</td>
                                        <td class="font-medium text-dark-medium">
                                            {{ \Carbon\Carbon::parse($statistics_giao_phan->ngay_thanh_lap)->format('Y') }}
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