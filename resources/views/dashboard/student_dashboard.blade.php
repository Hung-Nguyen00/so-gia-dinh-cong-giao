@extends('layouts.st_master')


{{-- @section('menu')
@extends('sidebar.dashboard')
@endsection --}}
@section('content')

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
                        <i class="la la-plus-square-o"></i>
                        <span class="nav-text">Plugins</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="uc-select2.html">Select 2</a></li>
                        <li><a href="uc-nestable.html">Nestedable</a></li>
                        <li><a href="uc-noui-slider.html">Noui Slider</a></li>
                        <li><a href="uc-sweetalert.html">Sweet Alert</a></li>
                        <li><a href="uc-toastr.html">Toastr</a></li>
                        <li><a href="map-jqvmap.html">Jqv Map</a></li>
                    </ul>
                </li>
                <li><a href="widget-basic.html" aria-expanded="false">
                        <i class="la la-desktop"></i>
                        <span class="nav-text">Widget</span>
                    </a></li>
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

    
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">


            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Admin Dashboard</h4>
                        <span class="ml-1">Student</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Student</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <div class="media ai-icon">
                                <span class="mr-3">
                                    <!-- <i class="ti-user"></i> -->
                                    <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" style="stroke-dasharray: 25, 45; stroke-dashoffset: 0;"></path>
                                        <path d="M8,7A4,4 0,1,1 16,7A4,4 0,1,1 8,7" style="stroke-dasharray: 26, 46; stroke-dashoffset: 0;"></path>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Patient</p>
                                    <h4 class="mb-0">3280</h4>
                                    <span class="badge badge-primary">+3.5%</span>
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
                                    <svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" style="stroke-dasharray: 66, 86; stroke-dashoffset: 0;"></path>
                                        <path d="M14,2L14,8L20,8" style="stroke-dasharray: 12, 32; stroke-dashoffset: 0;"></path>
                                        <path d="M16,13L8,13" style="stroke-dasharray: 8, 28; stroke-dashoffset: 0;"></path>
                                        <path d="M16,17L8,17" style="stroke-dasharray: 8, 28; stroke-dashoffset: 0;"></path>
                                        <path d="M10,9L9,9L8,9" style="stroke-dasharray: 2, 22; stroke-dashoffset: 0;"></path>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Bills</p>
                                    <h4 class="mb-0">2570</h4>
                                    <span class="badge badge-warning">+3.5%</span>
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
                                    <svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                        <path d="M12,1L12,23" style="stroke-dasharray: 22, 42; stroke-dashoffset: 0;"></path>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" style="stroke-dasharray: 43, 63; stroke-dashoffset: 0;"></path>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Revenue</p>
                                    <h4 class="mb-0">364.50K</h4>
                                    <span class="badge badge-danger">-3.5%</span>
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
                                    <svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
                                        <path d="M3,5A9,3 0,1,1 21,5A9,3 0,1,1 3,5" style="stroke-dasharray: 41, 61; stroke-dashoffset: 0;"></path>
                                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3" style="stroke-dasharray: 21, 41; stroke-dashoffset: 0;"></path>
                                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" style="stroke-dasharray: 49, 69; stroke-dashoffset: 0;"></path>
                                    </svg>
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Patient</p>
                                    <h4 class="mb-0">364.50K</h4>
                                    <span class="badge badge-success">-3.5%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
               

                <div class="col-xl-8 col-lg-8 col-xxl-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datatable</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Assigned Coach</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox2">
                                                    <label class="custom-control-label" for="checkbox2"></label>
                                                </div>
                                            </td>
                                            <td>Angelica Ramos</td>
                                            <td>Ashton Cox</td>
                                            <td>12 August 2020</td>
                                            <td>10:15</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox3">
                                                    <label class="custom-control-label" for="checkbox3"></label>
                                                </div>
                                            </td>
                                            <td>Bradley Greer</td>
                                            <td>Brenden Wagner</td>
                                            <td>11 July 2020</td>
                                            <td>10:00</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox4">
                                                    <label class="custom-control-label" for="checkbox4"></label>
                                                </div>
                                            </td>
                                            <td>Cedric Kelly</td>
                                            <td>Brielle Williamson</td>
                                            <td>10 May 2020</td>
                                            <td>09:45</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox5">
                                                    <label class="custom-control-label" for="checkbox5"></label>
                                                </div>
                                            </td>
                                            <td>Caesar Vance</td>
                                            <td>Herrod Chandler</td>
                                            <td>09 April 2020</td>
                                            <td>09:30</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox6">
                                                    <label class="custom-control-label" for="checkbox6"></label>
                                                </div>
                                            </td>
                                            <td>Rhona Davidson</td>
                                            <td>Sonya Frost</td>
                                            <td>08 March 2020</td>
                                            <td>09:15</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox7">
                                                    <label class="custom-control-label" for="checkbox7"></label>
                                                </div>
                                            </td>
                                            <td>Bradley Greer</td>
                                            <td>Brenden Wagner</td>
                                            <td>11 July 2020</td>
                                            <td>10:00</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-xxl-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive recentOrderTable">
                                <table class="table verticle-middle table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                                    <label class="custom-control-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Assigned Coach</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox2">
                                                    <label class="custom-control-label" for="checkbox2"></label>
                                                </div>
                                            </td>
                                            <td>Angelica Ramos</td>
                                            <td>Ashton Cox</td>
                                            <td>12 August 2020</td>
                                            <td>10:15</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox3">
                                                    <label class="custom-control-label" for="checkbox3"></label>
                                                </div>
                                            </td>
                                            <td>Bradley Greer</td>
                                            <td>Brenden Wagner</td>
                                            <td>11 July 2020</td>
                                            <td>10:00</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox4">
                                                    <label class="custom-control-label" for="checkbox4"></label>
                                                </div>
                                            </td>
                                            <td>Cedric Kelly</td>
                                            <td>Brielle Williamson</td>
                                            <td>10 May 2020</td>
                                            <td>09:45</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox5">
                                                    <label class="custom-control-label" for="checkbox5"></label>
                                                </div>
                                            </td>
                                            <td>Caesar Vance</td>
                                            <td>Herrod Chandler</td>
                                            <td>09 April 2020</td>
                                            <td>09:30</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox6">
                                                    <label class="custom-control-label" for="checkbox6"></label>
                                                </div>
                                            </td>
                                            <td>Rhona Davidson</td>
                                            <td>Sonya Frost</td>
                                            <td>08 March 2020</td>
                                            <td>09:15</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkbox7">
                                                    <label class="custom-control-label" for="checkbox7"></label>
                                                </div>
                                            </td>
                                            <td>Bradley Greer</td>
                                            <td>Brenden Wagner</td>
                                            <td>11 July 2020</td>
                                            <td>10:00</td>
                                            <td>
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);">Accept</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-xxl-4 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>About Me</h4>
                        </div>
                        <div class="student-info">
                            <div class="text-center container-fluid">
                                <div class="profile-photo">
                                    <img src="{{ URL::to('assets/images/profile/education/pic1.jpg') }}" width="100" class="img-fluid rounded-circle" alt="">
                                </div>
                                <h3 class="item-title">Soeng Souy</h3>
                                    <p>Web Developer and Web Designer</p>
                            </div>
                            <div class="table-responsive info-table">
                                <table class="table text-nowrap">
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td class="font-medium text-dark-medium">Soeng Souy</td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td class="font-medium text-dark-medium">Male</td>
                                        </tr>
                                        <tr>
                                            <td>Father Name:</td>
                                            <td class="font-medium text-dark-medium">Fahim Rahman</td>
                                        </tr>
                                        <tr>
                                            <td>Mother Name:</td>
                                            <td class="font-medium text-dark-medium">Jannatul Kazi</td>
                                        </tr>
                                        <tr>
                                            <td>Date Of Birth:</td>
                                            <td class="font-medium text-dark-medium">07.08.2006</td>
                                        </tr>
                                        <tr>
                                            <td>Religion:</td>
                                            <td class="font-medium text-dark-medium">Islam</td>
                                        </tr>
                                        <tr>
                                            <td>Father Occupation:</td>
                                            <td class="font-medium text-dark-medium">Graphic Designer</td>
                                        </tr>
                                        <tr>
                                            <td>E-Mail:</td>
                                            <td class="font-medium text-dark-medium">jessiarose@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <td>Admission Date:</td>
                                            <td class="font-medium text-dark-medium">05.01.2019</td>
                                        </tr>
                                        <tr>
                                            <td>Class:</td>
                                            <td class="font-medium text-dark-medium">2</td>
                                        </tr>
                                        <tr>
                                            <td>Section:</td>
                                            <td class="font-medium text-dark-medium">Pink</td>
                                        </tr>
                                        <tr>
                                            <td>Roll:</td>
                                            <td class="font-medium text-dark-medium">10005</td>
                                        </tr>
                                        <tr>
                                            <td>Adress:</td>
                                            <td class="font-medium text-dark-medium">House #10, Road #6,
                                                Australia</td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            <td class="font-medium text-dark-medium">+ 88 9856418</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
                    <div class="card profile-tab">
                        <div class="card-header">
                            <h4 class="card-title">Salary Status</h4>
                        </div>
                        <div class="card-body custom-tab-1">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link pb-2 active show">Professors</a></li>
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link pb-2">Librarian</a></li>
                                <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link pb-2">Other</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="my-posts" class="tab-pane fade active show">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Ammount</th>
                                                    <th scope="col">Transaction ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic1.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Angelica Ramos</td>
                                                    <td><span class="badge badge-rounded badge-success">Paid</span></td>
                                                    <td>12 August 2020</td>
                                                    <td>$100</td>
                                                    <td>#42317</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic2.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Bradley Greer</td>
                                                    <td><span class="badge badge-rounded badge-danger">Unpaid</span></td>
                                                    <td>11 July 2020</td>
                                                    <td>$200</td>
                                                    <td>#54682</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic3.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Cedric Kelly</td>
                                                    <td><span class="badge badge-rounded badge-warning">Pending</span></td>
                                                    <td>10 May 2020</td>
                                                    <td>$400</td>
                                                    <td>#57894</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic4.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Caesar Vance</td>
                                                    <td><span class="badge badge-rounded badge-danger">Unpaid</span></td>
                                                    <td>09 April 2020</td>
                                                    <td>$300</td>
                                                    <td>#57864</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic5.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Rhona Davidson</td>
                                                    <td><span class="badge badge-rounded badge-warning">Pending</span></td>
                                                    <td>08 March 2020</td>
                                                    <td>$500</td>
                                                    <td>#56387</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="about-me" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Ammount</th>
                                                    <th scope="col">Transaction ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic6.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Angelica Ramos</td>
                                                    <td><span class="badge badge-rounded badge-success">Paid</span></td>
                                                    <td>12 August 2020</td>
                                                    <td>$100</td>
                                                    <td>#42317</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic7.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Bradley Greer</td>
                                                    <td><span class="badge badge-rounded badge-danger">Unpaid</span></td>
                                                    <td>11 July 2020</td>
                                                    <td>$200</td>
                                                    <td>#54682</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic8.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Cedric Kelly</td>
                                                    <td><span class="badge badge-rounded badge-warning">Pending</span></td>
                                                    <td>10 May 2020</td>
                                                    <td>$400</td>
                                                    <td>#57894</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic10.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Caesar Vance</td>
                                                    <td><span class="badge badge-rounded badge-danger">Unpaid</span></td>
                                                    <td>09 April 2020</td>
                                                    <td>$300</td>
                                                    <td>#57864</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic9.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Rhona Davidson</td>
                                                    <td><span class="badge badge-rounded badge-warning">Pending</span></td>
                                                    <td>08 March 2020</td>
                                                    <td>$500</td>
                                                    <td>#56387</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="profile-settings" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Ammount</th>
                                                    <th scope="col">Transaction ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic5.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Angelica Ramos</td>
                                                    <td><span class="badge badge-rounded badge-success">Paid</span></td>
                                                    <td>12 August 2020</td>
                                                    <td>$100</td>
                                                    <td>#42317</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic8.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Bradley Greer</td>
                                                    <td><span class="badge badge-rounded badge-danger">Unpaid</span></td>
                                                    <td>11 July 2020</td>
                                                    <td>$200</td>
                                                    <td>#54682</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic6.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Cedric Kelly</td>
                                                    <td><span class="badge badge-rounded badge-warning">Pending</span></td>
                                                    <td>10 May 2020</td>
                                                    <td>$400</td>
                                                    <td>#57894</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic2.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Caesar Vance</td>
                                                    <td><span class="badge badge-rounded badge-danger">Unpaid</span></td>
                                                    <td>09 April 2020</td>
                                                    <td>$300</td>
                                                    <td>#57864</td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ URL::to('assets/images/profile/education/pic7.jpg') }}" class="rounded-circle" width="35" alt=""></td>
                                                    <td>Rhona Davidson</td>
                                                    <td><span class="badge badge-rounded badge-warning">Pending</span></td>
                                                    <td>08 March 2020</td>
                                                    <td>$500</td>
                                                    <td>#56387</td>
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
        </div>
    </div>
@endsection