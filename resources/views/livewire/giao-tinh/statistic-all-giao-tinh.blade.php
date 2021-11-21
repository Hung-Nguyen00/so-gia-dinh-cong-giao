<div>
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-8 p-md-0">
                <div class="welcome-text">
                    <h4>Thống kê toàn giáo phận</h4>
                    {{--<div class="d-flex col-sm-12 col-md-12 flex-wrap justify-content-start pt-2 pl-0">--}}
                        {{--<div class="col-md-4 col-sm-3 col-xs-3 form-group" style="max-width: 50%;">--}}
                            {{--<label>Ngày bắt đầu</label>--}}
                            {{--<input type="date" wire:model="start_date" class="form-control w-auto">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 col-xs-3 col-sm-3 form-group" style="max-width: 50%;">--}}
                            {{--<label>Ngày kết thúc</label>--}}
                            {{--<input type="date" class="form-control w-auto" wire:model="end_date">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-sm-4 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
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
                                    <img style="border-radius: 50%; max-width: 50px"
                                         src="{{ asset('images/giao_phan.jpg') }}" alt="Giáo phận">
                                </span>
                            <div class="text-white">
                                <p class="mb-1 width-card">Tổng số giáo phận</p>
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
                                    <img style="border-radius: 50%; max-width: 50px"
                                         src="{{ asset('images/nha_tho.png') }}" alt="Giáo xứ">
                                </span>
                            <div class="text-white">
                                Tổng giáo xứ
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
                                     <img style="border-radius: 50%; max-width: 60px"
                                          src="{{ asset('images/linhmuc.jpg') }}" alt="Linh mục">
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
                                   <img class="mt-1" style="border-radius: 50%; max-width: 50px"
                                        src="{{ asset('images/danso.jpg') }}" alt="Giáo dân">
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
                                   <img style="border-radius: 50%; max-width: 50px"
                                        src="{{ asset('images/rua_toi.png') }}" alt="Rửa tội">
                                </span>
                            <div class="text-white">
                                <p class="mb-1">Rửa tội</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-white" style="font-size: 16px"> {{ $statistic_bi_tich['rua_toi'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-warning">
                    <div class="card-body">
                        <div class="media">
                                <span class="mr-3">
                                  <img style="border-radius: 50%; max-width: 50px"
                                       src="{{ asset('images/rua_toi.jpg') }}" alt="Xưng tội">
                                </span>
                            <div class="text-white">
                                <p class="mb-1">Xưng tội</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-white fs-16" style="font-size: 16px"> {{ $statistic_bi_tich['xung_toi'] }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-secondary">
                    <div class="card-body">
                        <div class="media">
                                <span class="mr-3">
                                      <img style="border-radius: 50%; width: 60px; height: 60px;"
                                           src="{{ asset('images/them_suc.jpg') }}" alt="Thêm sức">
                                </span>
                            <div class="text-white">
                                <p class="mb-1">Thêm sức</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-white fs-16" style="font-size: 16px"> {{ $statistic_bi_tich['them_suc']}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-danger">
                    <div class="card-body">
                        <div class="media">
                                <span class="mr-3">
                                     <img style="border-radius: 50%; max-width: 55px"
                                          src="{{ asset('images/hon_nhan.png') }}" alt="Hôn nhân">
                                </span>
                            <div class="text-white">
                                <p class="mb-1" style="width: 120px;">Hôn phối</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-white fs-16" style="font-size: 16px"> {{ $statistic_bi_tich['hon_phoi']}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div wire:loading>
                <div id="loadingStaticGiaoPhan" class="la-ball-circus la-2x">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Biểu đồ thống kê toàn giáo phận</h4>
                    </div>
                    <div class="card-body" id="chart-responsive">
                        <div class="col-xl-6 col-xxl-6 col-sm-12">
                            <div class="w-75">
                                <label class="form-label">Chọn thống kê sinh hoặc tử năm
                                </label>
                                <select data-live-search="true"  class="form-control select w-auto mr-1"  wire:model="sinh_tu_follow_year">
                                    @for($i = 0; $i < sizeof($start_end_year); $i++)
                                        <option value="{{ $start_end_year[$i] }}" {{ $i == 0 ? 'selected' : '' }}> {{ $start_end_year[$i] }}</option>
                                    @endfor
                                </select>
                                <select  class="form-control select w-auto" wire:model="sinh_hoac_tu">
                                    <option value="1" selected>Sinh</option>
                                    <option value="2">Tử</option>
                                </select>
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
                        <div class="col-md-12 d-flex align-items-center justify-content-between p-0" style="margin-top: -10px">
                            <div>
                                <lable>Tìm kiếm giáo phận</lable>
                                <select class="select form-control w-auto" wire:model="giao_phan_id" data-live-search="true">
                                    <option value="" selected>Tìm kiếm giáo phận</option>
                                    @foreach($all_giao_phan as $gp)
                                        <option value="{{ $gp->id }}">{{ $gp->ten_giao_phan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive recentOrderTable">
                            <table class="table display"  style="min-width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th>Tên giáo phận</th>
                                    <th class="text-center">Tổng số giáo hạt</th>
                                    <th class="text-center">Tổng số giáo xứ</th>
                                    <th class="text-center">Tổng tu sĩ</th>
                                    <th class="text-center">Tổng giáo dân</th>
                                    <th class="text-center">Xem chi tiết</th>
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
                                        <td class="text-center">
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

@push('scripts')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart;
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
        var dataTuSi = <?php echo $analytic_tu_si; ?>;
        var piechart = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(piechart, {
            plugins: [ChartDataLabels],
            type: 'doughnut',
            data: {
                labels: Object.keys(dataTuSi),
                datasets: [{
                    label: 'My First Dataset',
                    data: Object.values(dataTuSi),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 22, 22)',
                    ],
                    hoverOffset: 4
                }],
            },
            options: {
                tooltips: {
                    enabled: false
                },
                plugins: {
                    datalabels: {
                        formatter: (value, dnct1) => {
                            let sum = 0;
                            let dataArr = dnct1.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value *100 / sum).toFixed(2);
                            if (percentage > 0){
                                return percentage+'%';
                            }else{
                                return '';
                            }
                        },
                        color: 'black',
                        font: {
                            size: 15,
                            weight: 'bold'
                        },
                    }
                }
            }
        });
        var analytics = <?php echo $analytic_gender; ?>;
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
                },

            }
        });
        Livewire.on('updateLineChart', data => {
            var dataGender = JSON.parse(data);
            myChart.data.datasets[0].data = dataGender.females;
            myChart.data.datasets[1].data = dataGender.males;
            myChart.data.labels = dataGender.month;
            myChart.update();
        });
        Livewire.on('updatePieChart', data => {
            var dataBiTich = JSON.parse(data);
            pieChart.data.datasets[0].data = Object.values(dataBiTich);
            pieChart.data.labels = Object.keys(dataBiTich);
            pieChart.update();
        });
    </script>
@endpush