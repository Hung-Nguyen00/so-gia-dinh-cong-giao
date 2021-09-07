<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quản lý sổ gia đình công giáo</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/images/logo-cong-giao.jpg') }}">
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/skin.css') }}">
    {{-- message toastr --}}
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 20px;
        }
        @page { size: 400pt 550pt; }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

<div class="container-fluid mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <a href="{{ route('so-gia-dinh.downloadPDF') }}" class="mb-1 btn btn-primary">Tải PDF</a>
            <div class="row tab-content">
                <div class="card w-100">
                    <div class="card-header">
                        <div class="col-xs-12">
                            <h4 class="card-title text-uppercase text-right  font-weight-bold">Chứng nhận hôn phối</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="font-weight-bold">Bên Nam</h4>
                        <div class="pl-1">
                            <p>Tên thánh, họ, gọi: </p>
                            <p>Sinh ngày: </p>
                            <p>Tại: </p>
                            <p>Con ông: </p>
                            <p>Và bà: </p>
                            <p>Rửa tội ngày: 20/11/2000  <span style="padding-left: 105px">tại: </span></p>
                            <p>Do linh mục: </p>
                            <p>Người đỡ đầu</p>
                            <p>RLLĐ ngày: 20/11/2000     <span style="padding-left: 110px">tại: </span></p>
                            <p>Thêm sức ngày: 20/11/2000  <span style="padding-left: 90px"> tại: </span></p>
                            <p>Do giám mục: </p>
                            <p>Người đỡ đầu: </p>
                            <p>Thuộc giáo xứ: Thạnh An  <span style="padding-left: 100px">Giáo phận: </span></p>
                        </div>
                        <h5 class="text-uppercase text-right font-weight-bold">Đã cử hành bí tích hôn phối</h5>
                        <div>
                            <p>Chữ ký của chồng: </p>
                            <p>Chữ ký của vợ: </p>
                            <p>Người chứng 1: </p>
                            <p>Người chứng 2: </p>
                        </div>
                        <hr>
                        <h4 class="font-weight-bold ">Bên Nữ</h4>
                        <div class="pl-1">
                            <p>Tên thánh, họ, gọi: </p>
                            <p>Sinh ngày: </p>
                            <p>Tại: </p>
                            <p>Con ông: </p>
                            <p>Và bà: </p>
                            <p>Rửa tội ngày: 20/11/2000  <span style="padding-left: 105px">tại: </span></p>
                            <p style="padding-left: 10px">Do linh mục: </p>
                            <p style="padding-left: 10px">Người đỡ đầu</p>
                            <p>RLLĐ ngày: 20/11/2000     <span style="padding-left: 110px">tại: </span></p>
                            <p style="padding-left: 10px">Thêm sức ngày: 20/11/2000  <span style="padding-left: 90px"> tại: </span></p>
                            <p style="padding-left: 10px">Do giám mục: </p>
                            <p style="padding-left: 10px">Người đỡ đầu: </p>
                            <p>Thuộc giáo xứ: Thạnh An  <span style="padding-left: 100px">Giáo phận: </span></p>
                        </div>
                        <h5 class="text-right text-uppercase font-weight-bold">Ngày: 04-11-200  <span style="padding-left: 110px">tại nhà thờ Thạnh An </span> </h5>
                        <div>
                            <p>Linh mục chứng hôn</p>
                            <p>Người chứng 1</p>
                            <p>Người chứng 2</p>
                        </div>
                        <hr>
                        <h4 class="font-weight-bold ">Con thứ </h4>
                        <div class="pl-1">
                            <p>Tên thánh, họ, gọi: </p>
                            <p>Sinh ngày: </p>
                            <p>Tại: </p>
                            <p>Con ông: </p>
                            <p>Và bà: </p>
                            <p>Rửa tội ngày: 20/11/2000  <span style="padding-left: 105px">tại: </span></p>
                            <p>Do linh mục: </p>
                            <p>Người đỡ đầu</p>
                            <p>RLLĐ ngày: 20/11/2000     <span style="padding-left: 110px">tại: </span></p>
                            <p>Thêm sức ngày: 20/11/2000  <span style="padding-left: 90px"> tại: </span></p>
                            <p>Do giám mục: </p>
                            <p>Người đỡ đầu: </p>
                            <p>Thuộc giáo xứ: Thạnh An  <span style="padding-left: 100px">Giáo phận: </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Required vendors -->
<script src="{{ URL::to('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ URL::to('assets/js/custom.min.js') }}"></script>
{!! Toastr::message() !!}
@yield('scripts')
@stack('scripts')
</body>
</html>