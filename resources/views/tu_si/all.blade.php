@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    @include('tu_si.import')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Các tu sĩ của giáo phận {{ $ten_giao_phan }}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý tu sĩ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Tu sĩ</a></li>
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
                                        <h4 class="card-title font-weight-bold">Danh sách các tu sĩ </h4>
                                        <div class="col-md-4 d-flex justify-content-end align-items-center" >
                                                <a href="{{ route('sgdcg-file-export', ['name' => 'tu_si'])}}"
                                                   style="margin-top: 11px !important;"
                                                   class="btn btn-info mr-2">Excel mẫu
                                                </a>
                                                <button type="button"
                                                        data-toggle="modal" data-target="#importModal"
                                                        class="btn btn-info mr-2" style="margin-top: 11px !important;">Import Excel
                                                </button>

                                                <a href="{{ route('tu-si.create') }}"
                                                   style="margin-top: 10px; margin-right: -10px;"
                                                   class="btn btn-primary">Thêm mới
                                                </a>
                                            </div>
                                    </div>
                                    @livewire('tu-si.crud-tu-si')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection