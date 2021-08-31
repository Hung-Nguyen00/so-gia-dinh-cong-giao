@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-capitalize">Giáo xứ {{ $ten_giao_xu }}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('so-gia-dinh.index') }}">Quản lý giáo xứ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Sổ gia đình công giáo</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                @livewire('sgdcg.crud-sgdcg', ['all_so_gia_dinh' => $all_so_gia_dinh])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection