<div>
    <div class="container-fluid position-relative">
        <div class="row page-titles mx-0">
            <div class="col-sm-9 p-md-0">
                <div class="welcome-text mb-2">
                    <h4>Thống kê giáo phận</h4>
                </div>

            </div>
            <div class="col-sm-3 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Thống kê giáo phận</a></li>
                </ol>
            </div>
        </div>
        <div class="row page-titles mx-0">
            <h5>Tìm kiếm theo giáo phận</h5>
            <div class="col-md-12 d-flex align-items-center justify-content-start flex-wrap p-0">
                <div class="col-md-4 form-group">
                    <label for="">Tên giáo phận</label>
                    <select class="selectpicker w-100 select form-control"  wire:model="giao_phan_id"
                            value="{{ old('giao_phan_id') }}"  data-live-search="true" >
                        @foreach($all_giao_phan as $cv)
                            <option value="{{ $cv->id }}">GT: {{ $cv->giaoTinh->ten_giao_tinh }} - GP: {{ $cv->ten_giao_phan }}</option>
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
                    <div class="card-body">
                        <div class="media">
                             <span class="mr-3">
                                 <img style="border-radius: 50%; max-width: 60px"
                                      src="{{ asset('images/giao_phan.jpg') }}" alt="Giáo phận">
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
                                  <img style="border-radius: 50%; max-width: 60px"
                                       src="{{ asset('images/nha_tho.png') }}" alt="Giáo xứ">
                                </span>
                            <div class="media-body">
                                <p class="mb-1">Số lượng giáo xứ</p>
                                <h4 class="mb-0">{{ $statistics_giao_phan->giao_xu_count }}</h4>
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
                                  <img style="border-radius: 50%; max-width: 60px"
                                       src="{{ asset('images/gia_dinh.png') }}" alt="Hộ gia đình">
                                </span>
                            <div class="media-body">
                                <p class="mb-1">Số lượng hộ gia đình</p>
                                <h4 class="mb-0">{{ $analytics_bi_tich['count_sgd'] }}</h4>
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
                                  <img style="border-radius: 50%; max-width: 60px"
                                       src="{{ asset('images/danso.jpg') }}" alt="Giáo dân">
                                </span>
                            <div class="media-body">
                                <p class="mb-1">Tổng số giáo dân</p>
                                <h4 class="mb-0" >{{ $analytics_bi_tich['count_tv'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-primary">
                    <div class="card-body">
                        <div class="media">
                                <span class="mr-3">
                                      <img style="border-radius: 50%; max-width: 60px"
                                           src="{{ asset('images/rua_toi.png') }}" alt="Rửa tội">
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
                                     <img style="border-radius: 50%; max-width: 50px"
                                          src="{{ asset('images/rua_toi.jpg') }}" alt="Xưng tội">
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
                                    <img style="border-radius: 50%; height: 60px; width: 60px"
                                         src="{{ asset('images/them_suc.jpg') }}" alt="Thên sức">
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
                                     <img style="border-radius: 50%; max-width: 50px"
                                          src="{{ asset('images/hon_nhan.png') }}" alt="Hôn nhân">
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
                           <h5>Thông kê tu sĩ</h5>
                           <canvas id="pieChart" width="50" style="height: 100px !important;" height="50"></canvas>
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
                        <div class="col-md-7 d-flex justify-content-end align-items-center">
                            <label for="">Tìm kiếm</label>
                            <select class="ml-2 form-control selectpicker w-75 select select"
                                    wire:model="giao_hat_id"
                                    data-live-search="true">
                                <option value="" selected>Chọn giáo hạt</option>
                                @foreach($statistics_giao_phan->giaoHat as $h)
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
                                    <th width="150">Tên giáo hạt</th>
                                    <th width="250">Linh mục quản hạt</th>
                                    <th width="50">Tổng giáo xứ</th>
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
                                            @if($th->tuSi->count() > 0)
                                               @foreach($th->tuSi as $ts)
                                                    <td> {{ $ts->tenThanh->ten_thanh}} {{$ts->ho_va_ten }}</td>
                                               @endforeach
                                            @else
                                                <td></td>
                                            @endif
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
                                    <td class="font-medium text-dark-medium"> {{ $statistics_giao_phan->tu_si_count }} </td>
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
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart;
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
        var dataTuSi = <?php echo $analytic_tu_si; ?>;
        var piechart = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(piechart, {
            type: 'doughnut',
            plugins: [ChartDataLabels],
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
                            weight: 'bold',
                        },
                        anchor: 'center',
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