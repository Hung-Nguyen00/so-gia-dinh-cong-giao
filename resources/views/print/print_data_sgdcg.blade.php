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
            margin-bottom: -5px;
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
                    <div class="logo" style="margin-bottom: 90px">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMgGAdNsYO4aX4lapdhBf3nEhoHaQVvFfv1w&usqp=CAU" alt="">
                    </div>
                    <h4 class="title fs-25" style="margin-top: 20px">Gia đình: {{ $thanh_vien_cha->ten_thanh . ' ' . $thanh_vien_cha->ho_va_ten }}</h4>
                    <div class="mt--3">
                        @if($sgdcg->giaoXu->giao_xu_hoac_giao_ho != 0)
                        <p class="fs-25">Giáo Họ: {{ $sgdcg->giaoXu->ten_giao_xu }} </p>
                        <p class="fs-25">Giáo Xứ: {{ $sgdcg->getTenGiaoXu($sgdcg->giaoXu->giao_xu_hoac_giao_ho) }}</p>
                            @else
                        <p class="fs-25">Giáo Họ:.........................................................................</p>
                        <p class="fs-25">Giáo Xứ: {{ $sgdcg->giaoXu->ten_giao_xu }}</p>
                        @endif
                        <p class="fs-25">Giáo Phận: {{ $sgdcg->giaoXu->giaoPhan->ten_giao_phan }} </p>
                        <p class="fs-25" style="margin-top: 80px">
                            Địa chỉ hành chính:{{ $thanh_vien_cha->dia_chi_hien_tai ? $thanh_vien_cha->dia_chi_hien_tai : '........................................................' }} </p>
                        <p class="fs-25">Điện thoại:{{ $thanh_vien_cha->so_dien_thoai ? $thanh_vien_cha->so_dien_thoai : '.....................................................................' }}</p>
                    </div>
                    <div class="page-break"></div>
                    <h4 class="title text-right fs-25">Chứng nhận</h4>
                    <h4 class="mt--3 fs-25" >Bên Nam</h4>
                    <h4 class="module">1. Thông tin</h4>
                    <div class="mt--3">
                        <p>Tên thánh - Họ và tên: {{ $thanh_vien_cha->ten_thanh . ' ' . $thanh_vien_cha->ho_va_ten }}</p>
                        <p>Sinh ngày: {{ \Carbon\Carbon::parse($thanh_vien_cha->ngay_sinh)->format('d-m-Y') }} </p>
                        <p>Tại: {{ $thanh_vien_cha->noi_sinh }}</p>
                        @if($thanh_vien_cha->giao_xu && $thanh_vien_cha->giao_phan)
                            <p>Thuộc giáo xứ: {{ $thanh_vien_cha->giao_xu }} <span style="padding-left: 100px">Giáo phận: {{ $thanh_vien_cha->giao_phan }}</span></p>
                        @else
                            <p>Thuộc giáo xứ: .............................. <span>Giáo phận: ....................................</span></p>
                        @endif
                        <h4>2. Bí tích đã nhận</h4>
                        @if($thanh_vien_cha_bt->count()  < 2)
                            <p>2.1 Rửa tội sức ngày: ................................
                                tại: ....................................</p>
                            <p class="pl-2">
                                - Do linh mục: ...................................................................................</p>
                            <p class="pl-2">
                                - Người đỡ đầu: .................................................................................</p>
                            <p>2.2 Xưng tội sức ngày: ..............................
                                tại: ....................................</p>
                            <p class="pl-2">
                                - Do linh mục: ...................................................................................</p>
                            <p class="pl-2">
                                - Người đỡ đầu: .................................................................................</p>
                            <p>2.3 Thêm sức ngày: ...................................tại: ...................................</p>
                            <p class="pl-2">
                                - Do linh mục: ...................................................................................</p>
                            <p class="pl-2">
                                - Người đỡ đầu: .................................................................................</p>
                        @endif
                        @php $i = 0 @endphp
                        @php $countLoop = 0; @endphp
                        @foreach($thanh_vien_cha_bt as $bt)
                            @if($bt->ten_bi_tich == 'Rửa tội')
                                <p>2.1. {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    tại: {{ $bt->noi_dien_ra }}</p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @elseif($bt->ten_bi_tich == 'Xưng tội')
                                <p>2.2. {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                   tại: {{ $bt->noi_dien_ra }}</p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                                @elseif($bt->ten_bi_tich == 'Thêm sức')
                                <p>2.3. {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                  tại: {{ $bt->noi_dien_ra }}</p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @endif
                                @php $countLoop ++; @endphp
                                @if($countLoop == $thanh_vien_me_bt->count())
                                    @if($countLoop == 2)
                                        <p>2.2 Xưng tội sức ngày: ..............................
                                            tại: ....................................</p>
                                        <p class="pl-2">
                                            - Do linh mục: ...................................................................................</p>
                                        <p class="pl-2">
                                            - Người đỡ đầu: .................................................................................</p>
                                        <p>2.3 Thêm sức ngày: ..............................
                                            tại: ........................................</p>
                                        <p class="pl-2">
                                            - Do linh mục: ...................................................................................</p>
                                        <p class="pl-2">
                                            - Người đỡ đầu: .................................................................................</p>
                                    @elseif($countLoop == 2)
                                        <p>2.3 Thêm sức ngày: ..............................
                                            tại: ........................................</p>
                                        <p class="pl-2">
                                            - Do linh mục: ...................................................................................</p>
                                        <p class="pl-2">
                                            - Người đỡ đầu: .................................................................................</p>
                                    @endif
                                @endif
                       @endforeach
                        <h4 class="title fs-22" style="text-align: right">Đã chịu phép hôn phối</h4>
                        @foreach($thanh_vien_me_bt as $bt)
                            @if($bt->ten_bi_tich == 'Hôn phối')
                                <div class="mt--3">
                                    <p>Người chứng 1: {{ $bt->ten_thanh_nguoi_lam_chung_2 .' '. $bt->ten_nguoi_lam_chung_2 }}</p>
                                    <p>Người chứng 2: {{ $bt->ten_thanh_nguoi_lam_chung_2 .' '. $bt->ten_nguoi_lam_chung_2 }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>

                @if($thanh_vien_me)
                <div class="page-break"></div>
                    <h4 class="title fs-25">Hôn phối</h4>
                    <h4 class="mt--3  fs-25">Bên Nữ</h4>
                    <h4 class="module">1. Thông tin</h4>
                    <div class="mt--3">
                        <p>Tên thánh - Họ và tên: {{ $thanh_vien_me->ten_thanh . ' ' . $thanh_vien_me->ho_va_ten }}</p>
                        <p>Sinh ngày: {{ \Carbon\Carbon::parse($thanh_vien_me->ngay_sinh)->format('d-m-Y') }}</p>
                        <p>Tại: {{ $thanh_vien_me->noi_sinh }}</p>
                        @if($thanh_vien_me->giao_xu && $thanh_vien_me->giao_phan)
                        <p>Thuộc giáo xứ: {{ $thanh_vien_me->giao_xu }}  <span style="padding-left: 100px">Giáo phận: {{ $thanh_vien_me->giao_phan }}</span></p>
                            @else
                        <p>Thuộc giáo xứ: .............................. <span>Giáo phận: ....................................</span></p>
                        @endif
                        <h4 class="">2. Bí tích đã nhận</h4>
                        @php $countLoop = 0 @endphp
                        @foreach($thanh_vien_me_bt as $bt)
                            @if($bt->ten_bi_tich == 'Rửa tội')
                                <p>2.1 {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    tại: {{ $bt->noi_dien_ra }}</p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @elseif($bt->ten_bi_tich == 'Xưng tội')
                                <p>2.2 {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                    tại: {{ $bt->noi_dien_ra }}</p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @elseif($bt->ten_bi_tich == 'Thêm sức')
                                <p>2.3 {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}
                                  tại: {{ $bt->noi_dien_ra }}</p>
                                <p class="pl-2">- Do linh mục: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p class="pl-2">- Người đỡ đầu {{ $bt->ten_thanh_nguoi_do_dau. ' '. $bt->ten_nguoi_do_dau }}</p>
                            @endif
                            @if($thanh_vien_me_bt->count()  < 2)
                                <p>2.1 Rửa tội sức ngày: ................................
                                    tại: ....................................</p>
                                <p class="pl-2">
                                    - Do linh mục: ...................................................................................</p>
                                <p class="pl-2">
                                    - Người đỡ đầu: .................................................................................</p>
                                <p>2.2 Xưng tội sức ngày: ..............................
                                    tại: ....................................</p>
                                <p class="pl-2">
                                    - Do linh mục: ...................................................................................</p>
                                <p class="pl-2">
                                    - Người đỡ đầu: .................................................................................</p>
                                <p>2.3 Thêm sức ngày: ...................................tại: ...................................</p>
                                <p class="pl-2">
                                    - Do linh mục: ...................................................................................</p>
                                <p class="pl-2">
                                    - Người đỡ đầu: .................................................................................</p>
                            @endif
                        @php $countLoop ++; @endphp
                        @if($countLoop == $thanh_vien_me_bt->count())
                            @if($countLoop == 2)
                                <p>2.2 Xưng tội sức ngày: ..............................
                                    tại: ....................................</p>
                                <p class="pl-2">
                                    - Do linh mục: ...................................................................................</p>
                                <p class="pl-2">
                                    - Người đỡ đầu: .................................................................................</p>
                                <p>2.3 Thêm sức ngày: ..............................
                                    tại: ........................................</p>
                                <p class="pl-2">
                                    - Do linh mục: ...................................................................................</p>
                                <p class="pl-2">
                                    - Người đỡ đầu: .................................................................................</p>
                            @elseif($countLoop == 2)
                                <p>2.3 Thêm sức ngày: ..............................
                                    tại: ........................................</p>
                                <p class="pl-2">
                                    - Do linh mục: ...................................................................................</p>
                                <p class="pl-2">
                                    - Người đỡ đầu: .................................................................................</p>
                            @endif
                        @endif
                        @endforeach
                    </div>
                        @foreach($thanh_vien_me_bt as $bt)
                            @if($bt->ten_bi_tich == 'Hôn phối')
                            <h4 class="title fs-22" style="text-align: left">Ngày: {{ \Carbon\Carbon::parse($bt->ngay_dien_ra)->format('d-m-Y') }}  tại {{ $bt->noi_dien_ra }}</h4>
                            <div class="mt--3">
                                <p>Linh mục chứng hôn: {{ $bt->ten_thanh_linh_muc .' '. $bt->ten_linh_muc }}</p>
                                <p>Người chứng 1: {{ $bt->ten_thanh_nguoi_lam_chung_2 .' '. $bt->ten_nguoi_lam_chung_2 }}</p>
                                <p>Người chứng 2: {{ $bt->ten_thanh_nguoi_lam_chung_2 .' '. $bt->ten_nguoi_lam_chung_2 }}</p>
                            </div>
                            @endif
                        @endforeach
            @endif
                        @php $count = 0 @endphp
                        @php $newModal = null @endphp
                        @php $countLoop = 0 @endphp
                        @php $countBiTich = 0 @endphp
                    @foreach($thanh_vien_con as $tv)
                      @if($newModal !== $tv->ten_thanh_vien || $count == 0)
                          @php $countBiTich = 0; @endphp
                          @php $countLoop = 0; @endphp
                            @foreach($thanh_vien_con as $th)
                                @if($th->ten_thanh_vien == $tv->ten_thanh_vien)
                                    @php $countBiTich ++; @endphp
                                @endif
                            @endforeach
                            <div class="page-break"></div>
                            <h4 class="title text-center fs-25">Con thứ {{ ++$count }}</h4>
                            <h4 class="module">1. Thông tin</h4>
                            <p>Tên thánh - Họ và tên: {{ $tv->ten_thanh_thanh_vien . ' '. $tv->ten_thanh_vien }}</p>
                            <p>Sinh ngày: {{ \Carbon\Carbon::parse($tv->ngay_sinh_thanh_vien)->format('d-m-Y') }}</p>
                            <p>Tại: {{ $tv->noi_sinh }}</p>
                            <h4>2. Bí tích đã nhận</h4>
                      @endif
                      @php $newModal = $tv->ten_thanh_vien @endphp
                          @if($tv->ten_bi_tich == 'Rửa tội')
                              <p>2.1 {{ $tv->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($tv->ngay_dien_ra)->format('d-m-Y') }}
                                 tại: {{ $tv->noi_dien_ra }}</p>
                              <p class="pl-2">- Do linh mục: {{ $tv->ten_thanh_linh_muc .' '. $tv->ten_linh_muc }}</p>
                              <p class="pl-2">- Người đỡ đầu: {{ $tv->ten_thanh_nguoi_do_dau. ' '. $tv->ten_nguoi_do_dau }}</p>
                          @elseif($tv->ten_bi_tich == 'Xưng tội')
                              <p>2.2 {{ $tv->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($tv->ngay_dien_ra)->format('d-m-Y') }}
                                 tại: {{ $bt->noi_dien_ra }}</p>
                              <p class="pl-2">- Do linh mục: {{ $tv->ten_thanh_linh_muc .' '. $tv->ten_linh_muc }}</p>
                              <p class="pl-2">- Người đỡ đầu: {{ $tv->ten_thanh_nguoi_do_dau. ' '. $tv->ten_nguoi_do_dau }}</p>
                          @elseif($tv->ten_bi_tich == 'Thêm sức')
                              <p>2.3 {{ $bt->ten_bi_tich }} ngày: {{ \Carbon\Carbon::parse($tv->ngay_dien_ra)->format('d-m-Y') }}
                                 tại: {{ $tv->noi_dien_ra }}</p>
                              <p class="pl-2">- Do linh mục: {{ $tv->ten_thanh_linh_muc .' '. $tv->ten_linh_muc }}</p>
                              <p class="pl-2">- Người đỡ đầu: {{ $tv->ten_thanh_nguoi_do_dau. ' '. $tv->ten_nguoi_do_dau }}</p>
                          @endif
                          @php $countLoop ++; @endphp
                        @if($countLoop == $countBiTich)
                            @if($countBiTich == 1)
                                <p>2.2 Xưng tội sức ngày: ..............................
                                    tại: ....................................</p>
                                <p class="pl-2">
                                    - Do linh mục: ...................................................................................</p>
                                <p class="pl-2">
                                    - Người đỡ đầu: .................................................................................</p>
                                <p>2.3 Thêm sức ngày: ..............................
                                    tại: ........................................</p>
                                <p class="pl-2">
                                    - Do linh mục: ...................................................................................</p>
                                <p class="pl-2">
                                    - Người đỡ đầu: .................................................................................</p>
                            @elseif($countBiTich == 2)
                                  <p>2.3 Thêm sức ngày: ..............................
                                      tại: ........................................</p>
                                  <p class="pl-2">
                                      - Do linh mục: ...................................................................................</p>
                                  <p class="pl-2">
                                      - Người đỡ đầu: .................................................................................</p>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>