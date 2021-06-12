<!DOCTYPE html>
<html lang="en">

<head>
	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/vendor/jqvmap/css/jqvmap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/vendor/chartist/css/chartist.min.css') }}">
	<!-- Summernote -->
    <link href="{{ URL::to('assets/vendor/summernote/summernote.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/skin-3.css') }}">
</head>
<body>
    <!-- Preloader start -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!-- Preloader end -->

    <!-- Main wrapper start -->
    <div id="main-wrapper">
        <!-- Nav header start -->
        <div class="nav-header">
            <a href="{{ route('home') }}" class="brand-logo">
                <img class="logo-abbr" src="assets/images/logo-white-3.png" alt="">
                <img class="logo-compact" src="assets/images/logo-text-white.png" alt="">
                <img class="brand-title" src="assets/images/logo-text-white.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!-- Nav header end -->
        <!-- Header start -->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell ai-icon" href="#" role="button" data-toggle="dropdown">
                                    <svg id="icon-user" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
										<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
										<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
									</svg>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <img src="{{ URL::to('assets/images/profile/education/pic1.jpg') }}" width="20" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header end ti-comment-alt -->

        <!-- Sidebar start -->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-home"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('home') }}">Admin</a></li>
                            <li><a href="{{ route('student_dashboard') }}">Students</a></li>
                            <li><a href="index-3.html">Teachers</a></li>
                            <li><a href="index-3.html">Parents</a></li>
                        </ul>
                    </li>
					<li><a class="ai-icon" href="event-management.html" aria-expanded="false">
							<i class="la la-calendar"></i>
							<span class="nav-text">Event Management</span>
						</a>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-user"></i>
							<span class="nav-text">Professors</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="all-professors.html">All Professor</a></li>
                            <li><a href="add-professor.html">Add Professor</a></li>
                            <li><a href="edit-professor.html">Edit Professor</a></li>
                            <li><a href="professor-profile.html">Professor Profile</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-users"></i>
							<span class="nav-text">Students</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="all-students.html">All Students</a></li>
                            <li><a href="add-student.html">Add Students</a></li>
                            <li><a href="edit-student.html">Edit Students</a></li>
                            <li><a href="about-student.html">About Students</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-graduation-cap"></i>
							<span class="nav-text">Courses</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="all-courses.html">All Courses</a></li>
                            <li><a href="add-courses.html">Add Courses</a></li>
                            <li><a href="edit-courses.html">Edit Courses</a></li>
                            <li><a href="about-courses.html">About Courses</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-book"></i>
							<span class="nav-text">Library</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="all-library.html">All Library</a></li>
                            <li><a href="add-library.html">Add Library</a></li>
                            <li><a href="edit-library.html">Edit Library</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-building"></i>
							<span class="nav-text">Departments</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="all-departments.html">All Departments</a></li>
                            <li><a href="add-departments.html">Add Departments</a></li>
                            <li><a href="edit-departments.html">Edit Departments</a></li>
                        </ul>
                    </li>
					
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-gift"></i>
							<span class="nav-text">Holiday</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="all-holiday.html">All Holiday</a></li>
                            <li><a href="add-holiday.html">Add Holiday</a></li>
                            <li><a href="edit-holiday.html">Edit Holiday</a></li>
                            <li><a href="holiday-calendar.html">Holiday Calendar</a></li>
                        </ul>
                    </li>
									
                    <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-users"></i>
							<span class="nav-text">Apps</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="app-profile.html">Profile</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                                <ul aria-expanded="false">
                                    <li><a href="email-compose.html">Compose</a></li>
                                    <li><a href="email-inbox.html">Inbox</a></li>
                                    <li><a href="email-read.html">Read</a></li>
                                </ul>
                            </li>
                            <li><a href="app-calender.html">Calendar</a></li>
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                                <ul aria-expanded="false">
                                    <li><a href="ecom-product-grid.html">Product Grid</a></li>
									<li><a href="ecom-product-list.html">Product List</a></li>
									<li><a href="ecom-product-detail.html">Product Details</a></li>
									<li><a href="ecom-product-order.html">Order</a></li>
									<li><a href="ecom-checkout.html">Checkout</a></li>
									<li><a href="ecom-invoice.html">Invoice</a></li>
									<li><a href="ecom-customers.html">Customers</a></li>
                                </ul>
                            </li>
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
                    <li class="nav-label">Table</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-table"></i>
							<span class="nav-text">Table</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>
				</ul>
            </div>
        </div>
        <!-- Sidebar end -->
		
        <!-- Content body start -->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="widget-stat card bg-primary">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-users"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">Total Students</p>
										<h3 class="text-white">3280</h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                                        </div>
										<small>80% Increase in 20 Days</small>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="widget-stat card bg-warning">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-user"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">New Students</p>
										<h3 class="text-white">245</h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 50%"></div>
                                        </div>
										<small>50% Increase in 25 Days</small>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="widget-stat card bg-secondary">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-graduation-cap"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">Total Course</p>
										<h3 class="text-white">28</h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 76%"></div>
                                        </div>
										<small>76% Increase in 20 Days</small>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="widget-stat card bg-danger">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-dollar"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">Fees Collection</p>
										<h3 class="text-white">25160$</h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
                                        </div>
										<small>30% Increase in 30 Days</small>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-6 col-xxl-6 col-lg-12 col-sm-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">University Survey</h3>
							</div>
							<div class="card-body">
								<div id="morris_bar_stalked" class="morris_chart_height" style="height: 300px !important;"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Donught Chart</h3>
							</div>
							<div class="card-body">
								<div id="morris_donught_2" class="morris_chart_height" style="height: 300px !important;"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">University Survey</h3>
							</div>
							<div class="card-body">
								<div id="morris_area" class="morris_chart_height" style="height: 300px !important;"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-6 col-md-6">
						<div class="card">
							<img class="img-fluid" src="{{ URL::to('assets/images/courses/pic1.jpg') }}" alt="">
							<div class="card-body">
								<h4><a href="about-courses.html">Why is Early Education Essential?</a></h4>
								<ul class="list-group mb-3 list-group-flush">
									<li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">April 23</span>
										<a href="javascript:void(0);"><i class="la la-heart-o mr-1"></i><strong>230</strong></a></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span class="mb-0">Duration :</span><strong>12 Months</strong></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span class="mb-0">Professor :</span><strong>Jack Ronan</strong></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span><i class="fa fa-graduation-cap text-primary mr-2"></i>Student</span><strong>+120</strong></li>
								</ul>
								<a href="about-courses.html" class="btn btn-primary">Read More</a>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-6 col-md-6">
						<div class="card">
							<img class="img-fluid" src="{{ URL::to('assets/images/courses/pic2.jpg') }}" alt="">
							<div class="card-body">
								<h4><a href="about-courses.html">The Shocking Revelation of Education.</a></h4>
								<ul class="list-group mb-3 list-group-flush">
									<li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">April 23</span>
										<a href="javascript:void(0);"><i class="la la-heart-o mr-1"></i><strong>230</strong></a></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span class="mb-0">Duration :</span><strong>12 Months</strong></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span class="mb-0">Professor :</span><strong>Jimmy Morris</strong></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span><i class="fa fa-graduation-cap text-primary mr-2"></i>Student</span><strong>+120</strong></li>
								</ul>
								<a href="about-courses.html" class="btn btn-primary">Read More</a>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-6 col-md-6">
						<div class="card">
							<img class="img-fluid" src="{{ URL::to('assets/images/courses/pic3.jpg') }}" alt="">
							<div class="card-body">
								<h4><a href="about-courses.html">Five Things Nobody Told You About</a></h4>
								<ul class="list-group mb-3 list-group-flush">
									<li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">April 23</span>
										<a href="javascript:void(0);"><i class="la la-heart-o mr-1"></i><strong>230</strong></a></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span class="mb-0">Duration :</span><strong>12 Months</strong></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span class="mb-0">Professor :</span><strong>Konne Backfield</strong></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span><i class="fa fa-graduation-cap text-primary mr-2"></i>Student</span><strong>+120</strong></li>
								</ul>
								<a href="about-courses.html" class="btn btn-primary">Read More</a>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-6 col-md-6">
						<div class="card">
							<img class="img-fluid" src="{{ URL::to('assets/images/courses/pic4.jpg') }}" alt="">
							<div class="card-body">
								<h4><a href="about-courses.html">Learn Python – Interactive Python Tutorial</a></h4>
								<ul class="list-group mb-3 list-group-flush">
									<li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">April 23</span>
										<a href="javascript:void(0);"><i class="la la-heart-o mr-1"></i><strong>230</strong></a></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span class="mb-0">Duration :</span><strong>12 Months</strong></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span class="mb-0">Professor :</span><strong>Nashid Martines</strong></li>
									<li class="list-group-item px-0 d-flex justify-content-between">
										<span><i class="fa fa-graduation-cap text-primary mr-2"></i>Student</span><strong>+120</strong></li>
								</ul>
								<a href="about-courses.html" class="btn btn-primary">Read More</a>
							</div>
						</div>
					</div>
					
					<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-12 col-sm-12">
						<div class="card">
                            <div class="card-body">
								<form action="#" method="post">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">To</span>
											</div>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Subject</span>
											</div>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="summernote"></div>
									</div>
									<div class="row align-items-center">
										<div class="col-lg-6">
											<div class="fallback w-100">
												<input type="file" class="dropify" data-default-file="">
											</div>
										</div>
										<div class="col-lg-6">
											<button type="button" class="btn btn-primary float-right">
												Send <i class="fa fa-paper-plane-o"></i>
											</button>									
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-12 col-sm-12">
						<div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Exam Toppers</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table verticle-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">Roll No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>542</td>
												<td>Jack Ronan</td>
                                                <td><span id="widget_sparklinedash"><canvas></canvas></span></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>243 </td>
                                                <td>Jimmy Morris</td>
                                                <td><div class="ico-sparkline"><div id="widget_spark-bar"></div></div></td>
												<td>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>452 </td>
                                                <td>Nashid Martines</td>
                                                <td><div class="ico-sparkline"><div id="widget_StackedBarChart"></div></div></td>
												<td>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>124</td>
                                                <td>Roman Aurora</td>
                                                <td> <div class="ico-sparkline"> <div id="widget_tristate"></div></div></td>
												<td>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>234</td>
                                                <td>Samantha</td>
                                                <td> <div class="ico-sparkline"> <div id="widget_composite-bar"></div> </div> </td>
												<td>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Student List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive recentOrderTable">
                                    <table class="table verticle-middle table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Assigned Professor</th>
                                                <th scope="col">Date Of Admit</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Fees</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
												<td>Jack Ronan</td>
                                                <td>Airi Satou</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge badge-rounded badge-primary">Checkin</span></td>
                                                <td>Commerce</td>
                                                <td>120$</td>
                                                <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>02 </td>
                                                <td>Jimmy Morris</td>
                                                <td>Angelica Ramos</td>
												<td>31 July 2020</td>
                                                <td><span class="badge badge-rounded badge-warning">Panding</span></td>
                                                <td>Mechanical</td>
                                                <td>120$</td>
                                                <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>03 </td>
                                                <td>Nashid Martines</td>
                                                <td>Ashton Cox</td>
												<td>30 July 2020</td>
                                                <td><span class="badge badge-rounded badge-danger">Canceled</span></td>
                                                <td>Science</td>
                                                <td>520$</td>
                                                <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>04</td>
                                                <td>Roman Aurora</td>
                                                <td>Cara Stevens</td>
												<td>29 July 2020</td>
                                                <td><span class="badge badge-rounded badge-success">Checkin</span></td>
                                                <td>Arts</td>
                                                <td>220$</td>
                                                <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>05</td>
                                                <td>Samantha</td>
                                                <td>Bruno Nash </td>
												<td>28 July 2020</td>
                                                <td><span class="badge badge-rounded badge-success">Checkin</span></td>
                                                <td>Maths</td>
                                                <td>130$</td>
                                                <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">Dexignlab</a> 2020</p>
            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <script src="{{ URL::to('assets/vendor/global/global.min.js') }}"></script>
	<script src="{{ URL::to('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/dlabnav-init.js') }}"></script>	
	
	<!-- Chart sparkline plugin files -->
    <script src="{{ URL::to('assets/vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/plugins-init/sparkline-init.js') }}"></script>
	
	<!-- Chart Morris plugin files -->
    <script src="{{ URL::to('assets/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('assets/vendor/morris/morris.min.js') }}"></script> 
	
    <!-- Init file -->
    <script src="{{ URL::to('assets/js/plugins-init/widgets-script-init.js') }}"></script>
	
	<!-- Demo scripts -->
    <script src="{{ URL::to('assets/js/dashboard/dashboard.js') }}"></script>
	
	<!-- Summernote -->
    <script src="{{ URL::to('assets/vendor/summernote/js/summernote.min.js') }}"></script>
    <!-- Summernote init -->
    <script src="{{ URL::to('assets/js/plugins-init/summernote-init.js') }}"></script>
	
	<!-- Svganimation scripts -->
    <script src="{{ URL::to('assets/vendor/svganimation/vivus.min.js') }}"></script>
    <script src="{{ URL::to('assets/vendor/svganimation/svg.animation.js') }}"></script>
    <script src="{{ URL::to('assets/js/styleSwitcher.js') }}"></script>
		
</body>
</html>