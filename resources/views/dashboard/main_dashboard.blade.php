@extends('layouts.st_master')
@section('content')
    <!-- Content body start -->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-7 p-md-0">
                    <div class="welcome-text d-flex justify-content-start align-items-center">
                        <h4>Thống kê toàn giáo phận</h4>
                    </div>
                </div>
                <div class="col-sm-5 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Thống kê toàn giáo phận</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-home"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1">Tổng số giáo phận</p>
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
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-street-view"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1">Rửa tội</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white" style="font-size: 16px"> {{ $analytics_bi_tich['rua_toi'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-warning">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-user-secret"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1">Xưng tội</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white fs-16" style="font-size: 16px"> {{ $analytics_bi_tich['xung_toi'] }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-secondary">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-glass"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1">Thêm sức</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white fs-16" style="font-size: 16px"> {{ $analytics_bi_tich['them_suc']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-danger">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-heart"></i>
                                </span>
                                <div class="text-white">
                                    <p class="mb-1" style="width: 120px;">Hôn phối</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-white fs-16" style="font-size: 16px"> {{ $analytics_bi_tich['hon_phoi']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Biểu đồ thống kê toàn giáo phận</h4>
                        </div>
                        <div class="card-body" id="chart-responsive">
                            <div class="col-xl-6 col-xxl-6 col-sm-12 col-md-12 p-0">
                                <div class="w-75">
                                    <label class="form-label">Chọn thống kê sinh hoặc tử năm {{ \Carbon\Carbon::now()->format('Y') }}</label>
                                    <select id="sinh_hoac_tu" class="form-control w-auto">
                                        <option value="1" selected>Sinh</option>
                                        <option value="2">Tử</option>
                                    </select>
                                </div>
                                <div id="loadDiv" class="d-none la-ball-circus">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                                <label class="position-absolute mt-2" style="font-size: 14px;">Số lượng</label>
                                <canvas id="myChart" class="pt-2" width="50" style="height: 100px !important;" height="50"></canvas>
                            </div>
                            <div class="col-xl-6 col-xxl-6 col-sm-12 p-0">
                                <label>Thông kê tu sĩ toàn giáo phận</label>
                                <canvas id="pieChart" width="50" style="height: 100px !important;" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh sách thống kê giáo phận</h4>
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
                                                <a href="home/giao-phan?giao_phan_id={{ $th->id }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
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


@section('scripts')
    <script type="text/javascript">
        var dataTuSi = <?php echo $analytic_tu_si; ?>;
        var piechart = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(piechart, {
            type: 'pie',
            data: {
                labels: Object.keys(dataTuSi),
                datasets: [{
                    label: 'My First Dataset',
                    data: Object.values(dataTuSi),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 22, 22)',
                    ],
                    hoverOffset: 4
                }]
            },
        });
        var url = $(location).attr("origin");
        var data_gender;
        var myChart;
        $( window ).on( "load", function() {
            var id = $('#sinh_hoac_tu').val();
            $.ajax({
                url: url+'/home/sinh-hoac-tu/' + id,
                type: 'get',
                dataType: 'json',
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loadDiv').removeClass('d-none')
                },
                success: function (response) {
                    data_gender = response.data;
                    if (response.data != null) {
                        var analytics = response.data;
                        var ctx = document.getElementById('myChart').getContext('2d');
                        myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels:analytics.month,
                                datasets: [{
                                    label: 'Nữ',
                                    data: analytics.females,
                                    backgroundColor: 'transparent',
                                    borderColor: 'red',
                                    borderWidth: 3,
                                    tension: 0.1,
                                }, {
                                    label: 'Nam',
                                    data: analytics.males,
                                    backgroundColor: 'transparent',
                                    borderColor: 'blue',
                                    borderWidth: 3,
                                    tension: 0.1,
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loadDiv').addClass('d-none')
                },
            })
        });

        $('#sinh_hoac_tu').change(function () {
            var id = $('#sinh_hoac_tu').val();
            $.ajax({
                url: url+'/home/sinh-hoac-tu/' + id,
                type: 'get',
                dataType: 'json',
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loadDiv').removeClass('d-none')
                },
                success: function (response) {
                    data_gender = response.data;
                    myChart.data.datasets[0].data = response.data.females;
                    myChart.data.datasets[1].data = response.data.males;
                    myChart.data.labels = response.data.month;
                    myChart.update();
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loadDiv').addClass('d-none')
                },
            })
        })
    </script>
@endsection
