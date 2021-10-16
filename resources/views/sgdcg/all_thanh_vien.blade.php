@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    @include('sgdcg.importXTTS')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-4 p-md-0">
                    <div class="welcome-text">
                        <h4>Thông tin giáo dân</h4>
                    </div>
                </div>
                <div class="col-sm-8 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Giáo dân</a></li>
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
                                        <h4 class="card-title font-weight-bold">Danh sách giáo dân</h4>
                                        <div class="col-md-4 d-flex justify-content-end align-items-center" >
                                            <a href="{{ route('sgdcg-file-export', ['name' => 'rua_toi_them_suc'])}}"
                                               style="margin-top: 11px !important;"
                                               class="btn btn-info  mr-2">Excel mẫu
                                            </a>
                                            <button type="button"
                                                    data-toggle="modal" data-target="#importModal"
                                                    class="btn btn-primary" style="margin-top: 11px !important;">Import  thêm sức hoặc xưng tội
                                            </button>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        @livewire('sgdcg.all-thanh-vien')
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