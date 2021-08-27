@extends('layouts.st_master')
@section('content')
    <!-- Content body start -->
    <div class="content-body">
        <!-- row -->
        {!! Toastr::message() !!}
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-home"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1">Tổng số phận</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white" style="font-size: 16px"> {{ $count['giao_phan_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-warning">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-home"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1">Tổng số giáo xứ</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white fs-16" style="font-size: 16px"> {{ $count['giao_xu_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-secondary">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-graduation-cap"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1">Tổng số tu sĩ</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white fs-16" style="font-size: 16px"> {{ $count['tu_si_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-danger">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-users"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1" style="width: 120px;">Tổng số giáo dân</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white fs-16" style="font-size: 16px"> {{ $count['giao_dan_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">New Student List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive recentOrderTable">
                                <table id="example3" class="display" style="min-width: 845px;">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên giáo phận</th>
                                            <th scope="col">Tổng số giáo hạt</th>
                                            <th scope="col">Tổng số giáo xứ</th>
                                            <th scope="col">Tổng tu sĩ</th>
                                            <th scope="col">Tổng giáo dân</th>
                                            <th scope="col">Xem chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i = 0 @endphp
                                    @foreach($statistics_giao_phan as $th)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $th->ten_giao_phan }}</td>
                                            <td class="text-center">{{ $th->giao_hat_count }}</td>
                                            <td class="text-center">{{ $th->giao_xu_count }}</td>
                                            <td class="text-center">{{ $th->tu_si_count }}</td>
                                            <td class="text-center">{{ $th->giao_dan_count }}</td>
                                            <td>
                                                <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
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