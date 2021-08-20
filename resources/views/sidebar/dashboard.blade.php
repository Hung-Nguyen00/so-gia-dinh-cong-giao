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
                    <li><a href="{{ route('ten-thanh.index') }}">Quản lý tên thánh</a></li>
                    <li><a href="{{ route('chuc-vu.index') }}">Quản lý chức vụ</a></li>
                    <li><a href="{{ route('vi-tri.index') }}">Quản lý vị trí</a></li>
                    <li><a href="{{ route('tu-si.search', ['chuc_vu_id' => 1])}}">Các tu sĩ</a></li>
                </ul>
            </li>
            <li class="nav-label">Forms</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-file-text"></i>
                    <span class="nav-text">Forms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="form-element.html">Form Elements</a></li>
                    <li><a href="form-wizard.html">Wizard</a></li>
                    <li><a href="form-editor-summernote.html">Summernote</a></li>
                    <li><a href="form-pickers.html">Pickers</a></li>
                    <li><a href="form-validation-jquery.html">Jquery Validate</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>