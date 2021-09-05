<div>
    <div class="container-fluid position-relative">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text d-flex justify-content-start align-items-center">
                    <h4>Thống kê giáo phận</h4>
                    <select class="selectpicker w-50 select form-control ml-2"  wire:model="giao_phan_id"
                            value="{{ old('giao_phan_id') }}"  data-live-search="true" >
                        @foreach($all_giao_phan as $cv)
                            <option value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Thống kê giáo phận</a></li>
                </ol>
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
                                <h4 class="mb-0"></h4>
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
                                <h4 class="mb-0"></h4>
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
            <div class="card-body">
                <div class="d-flex">
                    <div class="col-xl-6 col-xxl-6 col-sm-12">
                        <div class="w-50">
                            <label class="form-label">Chọn thống kê sinh hoặc tử</label>
                            <select id="sinh_hoac_tu" class="select form-control" wire:model="sinh_hoac_tu">
                                <option value="1" selected>Sinh</option>
                                <option value="2">Tử</option>
                            </select>
                        </div>
                        <canvas id="myChart" width="50" style="height: 100px !important;" height="50"></canvas>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-sm-12">
                        <h5>Thông kê tu sĩ</h5>
                        <canvas id="pieChart" width="50" style="height: 100px !important;" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-xxl-7 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Thông tin giáo phận</h4>
                        <div class="col-md-7 d-flex justify-content-end align-items-center">
                            <label for="">Tìm kiếm</label>
                            <select class="ml-2 form-control w-75 select" wire:model="giao_hat_id">
                                <option value="" selected>Chọn giáo hạt</option>
                                @foreach($all_giao_hat as $h)
                                    <option value="{{ $h->id }}"> {{ $h->ten_giao_hat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6 d-flex align-items-center p-0" style="margin-top: -10px">
                            <label for="">Hiển thị</label>
                            <select class="ml-2 form-control w-25 select" wire:model="paginate_number">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table display" style="min-width: 500px;">
                                <thead>
                                <tr>
                                    <th width="25">STT</th>
                                    <th width="100">Tên giáo hạt</th>
                                    <th width="100">Tổng giáo xứ</th>
                                    <th width="100">Tổng giáo dân</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 0; @endphp
                                @if($all_giao_hat->count() > 0)
                                    @foreach($all_giao_hat as $th)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $th->ten_giao_hat }}</td>
                                            <td class="text-center">{{ $th->giao_xu_count }}</td>
                                            <td class="text-center">{{ $th->giao_dan_count }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if(!$giao_hat_id)
                                <div class="d-flex justify-content-end">
                                    {{ $all_giao_hat->links() }}
                                </div>
                            @endif
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
                            <table class="table" id="table_id">
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
                                    <td class="font-medium text-dark-medium"></td>
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
@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
            $data_gender = <?php echo $analytic_gender; ?>;
            myChart.data.datasets[0].data = response.data.females;
            myChart.data.datasets[1].data = response.data.males;
            myChart.data.labels = response.data.month;
            myChart.update();
        });
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
        var myChart;
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
                }
            }
        });
    </script>
@endpush