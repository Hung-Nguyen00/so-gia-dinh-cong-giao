@extends('layouts.st_master')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Tất cả tên thánh</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý chung</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Tất cả tên thánh</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                @livewire('ten-thanh.crud-ten-thanh', ['all_ten_thanh' => $all_ten_thanh])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection