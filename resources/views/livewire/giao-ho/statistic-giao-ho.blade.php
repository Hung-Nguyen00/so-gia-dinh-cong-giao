<div>
    <div class="container-fluid position-relative">
        <div class="row page-titles mx-0">
            <div class="col-sm-7 p-md-0">
                <div class="welcome-text d-flex justify-content-start align-items-center">
                    <h4>Thống kê giáo họ</h4>
                </div>
            </div>
            <div class="col-sm-5 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Thống kê giáo xứ</a></li>
                </ol>
            </div>
        </div>
        <div class="row page-titles mx-0">
            <h5>Tìm kiếm theo giáo họ</h5>
            <div class="col-md-12 d-flex align-items-center justify-content-start flex-wrap p-0">
                <div class="col-md-3 form-group mr-2">
                    <label>Thống kê giáo họ</label>
                    <select class="selectpicker w-100 select form-control"  wire:model="giao_xu_id"
                            value="{{ old('giao_xu_id') }}"  data-live-search="true" >
                        @foreach($all_giao_xu as $cv)
                            <option value="{{ $cv->id }}">{{ $cv->ten_giao_xu }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label>Ngày bắt đầu</label>
                    <input type="date" wire:model="start_date" class="form-control w-100">
                </div>
                <div class="col-md-3 form-group">
                    <label>Ngày kết thúc</label>
                    <input type="date" class="form-control w-100" wire:model="end_date">
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
        <div class="row">
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                        <span class="mr-3">
                            <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/linhmuc.jpg') }}" alt="Linh mục">
                        </span>
                            <div class="media-body">
                                <p class="mb-1">Linh mục</p>
                                <h4 class="mb-0">{{ $statistics_giao_xu->tu_si_count }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media">
                             <span class="mr-3">
                                <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/gia_dinh.png') }}" alt="Hộ gia đình">
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Hộ gia đình</p>
                                <h4 class="mb-0">{{ $statistics_giao_xu->giao_ho_count }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                                <span class="mr-3">
                                 <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/chuyen_xu.jpg') }}" alt="Đã chuyển xứ">
                                </span>
                            <div class="media-body">
                                <p class="mb-1">Đã chuyển xứ</p>
                                <h4 class="mb-0">{{ $statistic_chuyen_xu }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                                <span class="mr-3">
                                 <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/chuyen_xu.jpg') }}" alt="Đã chuyển xứ">
                                </span>
                            <div class="media-body">
                                <p class="mb-1">Đã nhập xứ</p>
                                <h4 class="mb-0">{{ $statistics_giao_xu->ho_gia_dinh_count }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                                 <span class="mr-3">
                                  <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/danso.jpg') }}" alt="Giáo dân">
                                </span>
                            <div class="media-body">
                                <p class="mb-1">Giáo dân</p>
                                <h4 class="mb-0" >{{ $statistics_giao_xu->giao_dan_count }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                                 <span class="mr-3">
                                   <img style="max-width: 50px; border-radius: 50%" src="{{ asset('images/tre_so_sinh.jpg') }}" alt="Trẻ sơ sinh">
                                </span>
                            <div class="media-body">
                                <p class="mb-1">Trẻ sơ sinh (1)</p>
                                <h4 class="mb-0">{{ $statistic_age['so_sinh'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media">
                             <span class="mr-3">
                                <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/tre_em.png') }}" alt="Trẻ em">
                            </span>
                            <div class="media-body">
                                <p class="mb-1" style="min-width: 105px;">Nhi đồng (2t - 5t) </p>
                                <h4 class="mb-0">{{ $statistic_age['nhi_dong'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                                <span class="mr-3">
                                 <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/vi_thanh_nien.jpg') }}" alt="Thiếu nhi">
                                </span>
                            <div class="media-body">
                                <p class="mb-1 w-auto">Thiếu nhi (6t - 17t)</p>
                                <h4 class="mb-0">{{ $statistic_age['thieu_nhi']  }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                                <span class="mr-3">
                                 <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/thanh_nien.jpg') }}" alt="Thanh niên">
                                </span>
                            <div class="media-body">
                                <p class="mb-1 w-auto">Thanh niên (18t - 39t)</p>
                                <h4 class="mb-0">{{ $statistic_age['thieu_nhi']  }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                                <span class="mr-3">
                                 <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/trung_nien.png') }}" alt="Trung niên">
                                </span>
                            <div class="media-body">
                                <p class="mb-1 w-auto">Trung niên (40t - 64t)</p>
                                <h4 class="mb-0">{{ $statistic_age['trung_nien']  }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body d-flex align-items-center">
                        <div class="media ai-icon">
                                 <span class="mr-3">
                                 <img style="max-width: 60px; border-radius: 50%" src="{{ asset('images/tuoi_gia.jpg') }}" alt="Tuổi già">
                                </span>
                            <div class="media-body">
                                <p class="mb-1">Tuổi già (>65t)</p>
                                <h4 class="mb-0" >{{ $statistic_age['tuoi_gia'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body" id="chart-responsive">
                        <div class="col-xl-6 col-xxl-6 col-sm-12">
                            <div class="w-75">
                                <label class="form-label">Chọn thống kê sinh hoặc tử năm
                                </label>
                                <select  class="form-control select w-auto mr-1" wire:model="sinh_tu_follow_year">
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
                        <div class="col-xl-6 col-xxl-6 col-sm-12">
                            <h5>Thông kê bí tích</h5>
                            <canvas id="pieChart" width="50" style="height: 100px !important;" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-xxl-5 h-50 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Thông tin giáo xứ {{ $statistics_giao_xu->ten_giao_xu }}</h4>
                    </div>
                    <div class="student-info">
                        <div class="table-responsive info-table">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Linh mục:</td>
                                    <td class="font-medium  text-break text-dark-medium">
                                        @if($linh_muc_chanh_xu)
                                        {{ $linh_muc_chanh_xu->tenThanh->ten_thanh }} {{ $linh_muc_chanh_xu->ho_va_ten }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nhà thờ</td>
                                    <td class="font-medium text-break text-dark-medium">
                                        {{ $statistics_giao_xu->ten_giao_xu }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td class="font-medium text-break text-dark-medium">
                                        {{ $statistics_giao_xu->dia_chi }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Số lượng linh mục</td>
                                    <td class="font-medium text-dark-medium"> {{ $statistics_giao_xu->tu_si_count }}</td>
                                </tr>
                                <tr>
                                    <td>Năm thành lập</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ \Carbon\Carbon::parse($statistics_giao_xu->ngay_thanh_lap)->format('Y') }}
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
@push('scripts')
    <script>
        var myChart;
        var dataBiTich = <?php echo $analytics_bi_tich; ?>;
        var piechart = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(piechart, {
            type: 'pie',
            data: {
                labels: Object.keys(dataBiTich),
                datasets: [{
                    label: 'My First Dataset',
                    data: Object.values(dataBiTich),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 22, 22)',
                    ],
                    hoverOffset: 4
                }],
            },
        });
        var analytics = <?php echo $analytic_gender; ?>;
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
                },

            }
        });
        Livewire.on('updateLineChart', data => {
            var dataGender = JSON.parse(data);
            myChart.data.datasets[0].data = dataGender.females;
            myChart.data.datasets[1].data = dataGender.males;
            myChart.data.labels = dataGender.month;
            myChart.update();
            $('.select').selectpicker();
        });
        Livewire.on('updatePieChart', data => {
            var dataBiTich = JSON.parse(data);
            pieChart.data.datasets[0].data = Object.values(dataBiTich);
            pieChart.data.labels = Object.keys(dataBiTich)
            pieChart.update();
        });
    </script>
@endpush