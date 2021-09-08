<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{public_path('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{public_path('assets/css/skin.css') }}">
    <title>Quản lý sổ gia đình công giáo</title>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 20px;
        }
        @page { size: 418pt 594pt; }
        .page-break {
            page-break-after: always;
        }
        .text-right{
            text-align: right;
        }
        .title{
            text-transform: uppercase;
            color: red;
        }
        .mt--3{
            margin-top: -30px
        }
        .mt--2{
            margin-top: -20px
        }
        .text-center{
            text-align: center;
        }
        .fs-20{
            font-size: 20px;
        }
        .module{
            margin-top: -15px;
        }
        .fs-25{
            font-size: 25px;
        }
        .fs-22{
            font-size: 22px;
        }
        .fs-50{
            font-size: 50px;
        }
        .pl-2{
            padding-left: 20px;
        }
        .pl-3{
            padding-left: 30px;
        }
        p{
            margin-bottom: -10px;
        }
        .logo{
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container-fluid mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="row tab-content">
                <div class="pl-3">
                    <h4 class="title fs-50 text-center">Sổ gia đình</h4>
                    <div class="logo">
                        <img src="https://lh3.googleusercontent.com/proxy/QnH1PlEI2DDRCDJjkScdCNSsjm5KGizkTRLnpZA9UXec2k32FKrArD6jn6JopH_7XSBGyyjjR6rkD3iqPi16ts6kIdXS6JNo8uJb18rpQ6dtXzC90VjYjQqOjAahAyTUxTSY" alt="">
                    </div>
                    <h4 class="title fs-22"  style="margin-top: 20px">Gia đình: </h4>
                    <div class="mt--3">
                        @if($sgdcg->giaoXu->giao_xu_hoac_giao_ho != 0)
                        <p class="fs-25">Giáo Họ: {{ $sgdcg->giaoXu->ten_giao_xu }} </p>
                        <p class="fs-25">Giáo Xứ: {{ $sgdcg->getTenGiaoXu($sgdcg->giaoXu->giao_xu_hoac_giao_ho) }}</p>
                            @else
                        <p class="fs-25">Giáo Họ: </p>
                        <p class="fs-25">Giáo Xứ: {{ $sgdcg->giaoXu->ten_giao_xu }}</p>
                        @endif
                        <p class="fs-25">Giáo Phận: {{ $sgdcg->giaoXu->giaoPhan->ten_giao_phan }} </p>
                        <p class="fs-25" style="margin-top: 80px">Địa chỉ hành chính: {{ $thanh_vien_cha->dia_chi_hien_tai }} </p>
                        <p class="fs-25">Điện thoại: {{ $thanh_vien_cha->so_dien_thoai }}</p>
                    </div>
                    <div class="page-break"></div>
                    <h4 class="title text-right fs-25">Chứng nhận</h4>
                    <h4 class="mt--3 fs-25" >Bên Nam</h4>
                    <h4 class="module">1. Thông tin</h4>
                    <div class="mt--3">
                        <p>1.1 Tên thánh, họ, gọi: {{ $thanh_vien_cha->ten_thanh . ' ' . $thanh_vien_cha->ho_va_ten }}</p>
                        <p>1.2 Sinh ngày: {{ \Carbon\Carbon::parse($thanh_vien_cha->ngay_sinh)->format('d-m-Y') }} </p>
                        <p>1.3 Tại: </p>
                        @foreach($info_cha_me_cha as $info)
                            @if($info->chuc_vu_gd == 'Cha')
                                <p>1.4 Con ông: {{ $info->ten_thanh .' '. $info->ho_va_ten }} </p>
                            @else
                                <p>1.5 Và bà: {{ $info->ten_thanh .' '. $info->ho_va_ten }}</p>
                            @endif
                        @endforeach
                        <p>1.6 Thuộc giáo xứ: Thạnh An  <span style="padding-left: 128px">Giáo phận: </span></p>
                        <h4>2. Bí tích đã nhận</h4>
                        @php $i = 0 @endphp
                        @foreach($thanh_vien_cha_bt as $bt)
                            @if($bt->ten_bi_tich == 'Rửa tội')
                                <p>2.1. {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    <span style="padding-left: 110px;">tại: {{ $bt->noi_dien_ra }}</span></p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @elseif($bt->ten_bi_tich == 'Xưng tội')
                                <p>2.2. {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    <span style="padding-left: 100px;">tại: {{ $bt->noi_dien_ra }}</span></p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                                @elseif($bt->ten_bi_tich == 'Thêm sức')
                                <p>2.3. {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    <span style="padding-left: 90px;">tại: {{ $bt->noi_dien_ra }}</span></p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @endif
                       @endforeach
                    </div>
                    <h4 class="title text-right fs-22">Đã cử hành bí tích hôn phối</h4>
                    <h4>3. Thông tin hôn phối</h4>
                    <div class="mt--3">
                        @foreach($thanh_vien_me_bt as $bt)
                            @if($bt->ten_bi_tich == 'Hôn phối')
                                <p class="pl-2">- Người chứng 1: {{ $bt->ten_thanh_nguoi_lam_chung_2 .' '. $bt->ten_nguoi_lam_chung_2 }}</p>
                                <p class="pl-2">- Người chứng 2: {{ $bt->ten_thanh_nguoi_lam_chung_2 .' '. $bt->ten_nguoi_lam_chung_2 }}</p>
                            @endif
                        @endforeach
                    </div>
                @if($thanh_vien_me)
                <div class="page-break"></div>
                    <h4 class="title fs-25">Hôn phối</h4>
                    <h4 class="mt--3  fs-25">Bên Nữ</h4>
                    <h4 class="module">1. Thông tin</h4>
                    <div class="mt--3">
                        <p>1.1 Tên thánh, họ, gọi: {{ $thanh_vien_me->ten_thanh . ' ' . $thanh_vien_me->ho_va_ten }}</p>
                        <p>1.2 Sinh ngày: {{ \Carbon\Carbon::parse($thanh_vien_me->ngay_sinh)->format('d-m-Y') }}</p>
                        <p>1.3 Tại: </p>
                        @foreach($info_cha_me_me as $info)
                            @if($info->chuc_vu_gd == 'Cha')
                                <p>1.4 Con ông: {{ $info->ten_thanh .' '. $info->ho_va_ten }} </p>
                            @else
                                <p>1.5 Và bà: {{ $info->ten_thanh .' '. $info->ho_va_ten }}</p>
                            @endif
                        @endforeach
                        <p>1.6 Thuộc giáo xứ: Thạnh An  <span style="padding-left: 128px">Giáo phận: </span></p>
                        <h4 class="">2. Bí tích đã nhận</h4>
                        @foreach($thanh_vien_me_bt as $bt)
                            @if($bt->ten_bi_tich == 'Rửa tội')
                                <p>2.1 {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    <span style="padding-left: 110px;">tại: {{ $bt->noi_dien_ra }}</span></p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @elseif($bt->ten_bi_tich == 'Xưng tội')
                                <p>2.2 {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    <span style="padding-left: 100px;">tại: {{ $bt->noi_dien_ra }}</span></p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @elseif($bt->ten_bi_tich == 'Thêm sức')
                                <p>2.3 {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    <span style="padding-left: 90px;">tại: {{ $bt->noi_dien_ra }}</span></p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @endif
                        @endforeach

                    </div>
                    @foreach($thanh_vien_me_bt as $bt)
                        @if($bt->ten_bi_tich == 'Hôn phối')
                        <h4 class="title fs-22" >Ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}  <span style="padding-left: 110px">tại {{ $bt->noi_dien_ra }} </span> </h4>
                        <h4>3. Thông tin hôn phối</h4>
                        <div class="mt--3" >
                        <p class="pl-2">- Linh mục chứng hôn: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                        </div>
                    @endif
                    @endforeach
            @endif
                        @php $count = 0 @endphp
                        @php $newModal = null @endphp
                    @foreach($thanh_vien_con as $tv)
                      @if($newModal !== $tv->ten_thanh_vien || $count == 0)
                            <div class="page-break"></div>
                            <h4 class="title text-center fs-25">Con thứ {{ ++$count }}</h4>
                            <h4 class="module">1. Thông tin</h4>
                            <p>1.1 Tên thánh, họ, gọi: {{ $tv->ten_thanh_thanh_vien . ' '. $tv->ten_thanh_vien }}</p>
                            <p>1.2 Sinh ngày: {{ \Carbon\Carbon::parse($tv->ngay_sinh_thanh_vien)->format('d-m-Y') }}</p>
                            <p>1.3 Tại: </p>
                            <h4>2. Bí tích đã nhận</h4>
                      @endif
                      @php $newModal = $tv->ten_thanh_vien @endphp
                          @if($tv->ten_bi_tich == 'Rửa tội')
                              <p>2.1 {{ $tv->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($tv->ngay_dien_ra)->format('d-m-Y') }}
                                  <span style="padding-left: 110px;">tại: {{ $tv->noi_dien_ra }}</span></p>
                              <p class="pl-2">- Do linh mục: {{ $tv->ten_thanh_linh_muc .' '. $tv->ten_linh_muc }}</p>
                              <p class="pl-2">- Người đỡ đầu {{ $tv->ten_thanh_nguoi_do_dau. ' '. $tv->ten_nguoi_do_dau }}</p>
                          @elseif($tv->ten_bi_tich == 'Xưng tội')
                              <p>2.2 {{ $tv->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($tv->ngay_dien_ra)->format('d-m-Y') }}
                                  <span style="padding-left: 100px;">tại: {{ $bt->noi_dien_ra }}</span></p>
                              <p class="pl-2">- Do linh mục: {{ $tv->ten_thanh_linh_muc .' '. $tv->ten_linh_muc }}</p>
                              <p class="pl-2">- Người đỡ đầu {{ $tv->ten_thanh_nguoi_do_dau. ' '. $tv->ten_nguoi_do_dau }}</p>
                          @elseif($tv->ten_bi_tich == 'Thêm sức')
                              <p>2.3 {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($tv->ngay_dien_ra)->format('d-m-Y') }}
                                  <span style="padding-left: 90px;">tại: {{ $tv->noi_dien_ra }}</span></p>
                              <p class="pl-2">- Do linh mục: {{ $tv->ten_thanh_linh_muc .' '. $tv->ten_linh_muc }}</p>
                              <p class="pl-2">- Người đỡ đầu: {{ $tv->ten_thanh_nguoi_do_dau. ' '. $tv->ten_nguoi_do_dau }}</p>
                          @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>