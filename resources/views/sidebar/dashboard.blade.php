<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Các menu chính</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Bảng điều khiển</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    {{--<li><a href="{{ route('student_dashboard') }}">Students</a></li>--}}
                    {{--<li><a href="{{ route('teacher_dashboard') }}">Teachers</a></li>--}}
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Quản lý giáo phận</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('giao-tinh.index') }}">Các giáo tỉnh</a></li>
                    <li><a href="{{ route('giao-phan.index')}}">Các giáo phận</a></li>
                    <li><a href="{{ route('giao-hat.index') }}">Các giáo hạt</a></li>
                    <li><a href="{{ route('giao-xu.index') }}">Các giáo xứ</a></li>
                    <li><a href="{{ route('giao-ho.index') }}">Các giáo họ</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Quản lý tu sĩ</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('ten-thanh.index') }}">Tên thánh</a></li>
                    <li><a href="{{ route('chuc-vu.index') }}">Chức vụ</a></li>
                    <li><a href="{{ route('vi-tri.index') }}">Vị trí</a></li>
                    <li><a href="{{ route('tu-si.search', ['chuc_vu_id' => 1])}}">Tu sĩ</a></li>
                    <li><a href="{{ route('tu-dong.search', ['chuc_vu_id' => 2])}}">Tu sĩ thuộc nhà dòng</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Quản lý giáo xứ</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('giaoXu.showTuSi') }}">Tu sĩ</a></li>
                    <li><a href="{{ route('bi-tich.index') }}">Bí tích</a></li>
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