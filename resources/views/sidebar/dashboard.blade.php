<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Các menu chính</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Bảng thống kê</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('home') }}">Giáo phận</a></li>
                    <li>
                        <a href="{{ route('home.giaoPhan', \Illuminate\Support\Facades\Auth::user()->giao_phan_id)}}">
                            Thống kê của giáo phận</a></li>
                    <li>
                        <a href="{{ route('home.giaoXu')}}">
                            Thống kê của giáo xứ</a></li>
                </ul>
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()->quanTri->ten_quyen == 'Giáo phận' || \Illuminate\Support\Facades\Auth::user()->quanTri->ten_quyen == 'admin')
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Quản lý giáo phận</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('giao-tinh.index') }}">Các giáo tỉnh</a></li>
                    <li><a href="{{ route('giao-phan.index')}}">Các giáo phận</a></li>
                    <li><a href="{{ route('giao-hat.index') }}">Các giáo hạt</a></li>
                    <li><a href="{{ route('giao-xu.index') }}">Các giáo xứ</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Quản lý tu sĩ</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('tu-si.search', ['chuc_vu' => 'Giám mục'])}}">Tu sĩ</a></li>
                    <li><a href="{{ route('tu-dong.search', ['chuc_vu_id' => 2])}}">Tu sĩ thuộc nhà dòng</a></li>
                </ul>
            </li>
            @endif
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-pencil"></i>
                    <span class="nav-text">Quản lý chung</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('ten-thanh.index') }}">Tên thánh</a></li>
                    @if(\Illuminate\Support\Facades\Auth::user()->quanTri->ten_quyen == 'Giáo phận' || \Illuminate\Support\Facades\Auth::user()->quanTri->ten_quyen == 'admin')
                    <li><a href="{{ route('chuc-vu.index') }}">Chức vụ</a></li>
                    @endif
                    <li><a href="{{ route('bi-tich.index') }}">Bí tích</a></li>
                    <li><a href="{{ route('vi-tri.index') }}">Vị trí trong giáo xứ</a></li>
                    <li><a href="{{ route('nha-dong.index') }}">Nhà dòng</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Quản lý giáo xứ</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('giaoXu.showTuSi') }}">Tu sĩ</a></li>
                    <li><a href="{{ route('giao-ho.index') }}">Giáo họ</a></li>
                    <li><a href="{{ route('so-gia-dinh.index') }}">Sổ gia đình công giáo</a></li>
                    <li><a href="{{ route('thanh-vien.index') }}">Giáo dân</a></li>
                </ul>
            </li>
            <li class="nav-label">Quản trị</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-user"></i>
                    <span class="nav-text">Quản lý tài khoản</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('tai-khoan.index') }}">Tài khoản</a></li>
                    @if(\Illuminate\Support\Facades\Auth::user()->quanTri->ten_quyen !== 'admin')
                        <li><a href="{{ route('tai-khoan.create')}}">Thêm tài khoản</a></li>
                    @else
                        <li><a href="{{ route('register')}}">Thêm tài khoản</a></li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</div>