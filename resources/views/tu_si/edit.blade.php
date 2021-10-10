@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thông tin tu sĩ</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý tu sĩ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tu-si.index') }}">Dánh sách tu sĩ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div>
                                    <div class="card-header">
                                        <h4 class="card-title">Chỉnh sửa thông tin tu sĩ</h4>
                                    </div>
                                    <div  class="card-body">
                                        @livewire('tu-si.edit-tu-si', ['tu_si' => $tu_si])
                                        <div style="margin-top: 50px">
                                            <hr>
                                        </div>
                                        <div class="" style="margin-top: 30px">
                                            <h4>Lịch sử phục vụ {{ $tu_si->chucVu->ten_chuc_vu }} {{ $tu_si->ho_va_ten }}</h4>
                                            @livewire('tu-si.lich-su-phuc-vu', ['tu_si' => $tu_si])
                                        </div>
                                        <div style="margin-top: 50px">
                                            <hr>
                                        </div>
                                        <div class="" style="margin-top: 30px">
                                            <h4>Lịch sử nhận chức {{ $tu_si->chucVu->ten_chuc_vu }} {{ $tu_si->ho_va_ten }}</h4>
                                            @livewire('tu-si.lich-su-nhan-chuc', ['tu_si' => $tu_si])
                                        </div>
                                    </div>
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

