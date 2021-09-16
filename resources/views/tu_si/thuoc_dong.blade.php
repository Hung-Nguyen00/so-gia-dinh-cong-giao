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
                        <h4>Các tu sĩ thuộc nhà dòng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý tu sĩ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Tu sĩ thuộc nhà dòng</a></li>
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
                                        <h4 class="card-title">Danh sách các tu sĩ thuộc nhà dòng </h4>
                                    </div>
                                    <form action="{{ route('tu-dong.search')}}">
                                        <div class="col-md-12 mt-2 d-flex justify-content-around">
                                            <div class="d-flex justify-content-start col-md-8">
                                                <div class="form-group" style="margin-left: -10px;">
                                                    <div wire:ignore>
                                                        <lable class="col-form-label">Tìm kiếm tu sĩ theo chức vụ</lable>
                                                        <select class="selectpicker form-control pt-1" name="chuc_vu_id" data-live-search="true">
                                                            @foreach($all_chuc_vu as $cv)
                                                                @if($cv->id === $chuc_vu_id)
                                                                    <option selected value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                                                                @else
                                                                    <option  value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <button type="submit" class="ml-2 mt-3 btn btn-sm btn-primary">Tìm kiếm</button>
                                                </div>
                                            </div>
                                            <div class="col-md-4 d-flex justify-content-end align-items-center" >
                                                <button type="button"
                                                        data-toggle="modal" data-target="#importModal"
                                                        class="btn btn-info mr-2" style="margin-top: 11px !important;">Import Excel
                                                </button>

                                                <a href="{{ route('tu-si.create') }}"
                                                   style="margin-top: 10px; margin-right: -10px;"
                                                   class="btn btn-primary">Thêm tu sĩ
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                    <div  class="card-body" wire:ignore>
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th >STT</th>
                                                    <th>Họ và tên</th>
                                                    <th>Tên thánh</th>
                                                    <th>Tên dòng</th>
                                                    <th style="width: 100px">Ngày sinh</th>
                                                    <th>Đang phục vụ giáo xứ</th>
                                                    <th >Chỉnh sửa</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                                                @php $i= 0; @endphp
                                                @foreach($all_tu_si as $th)
                                                    <tr >
                                                        <td class="text-center"> {{ ++$i }}</td>
                                                        <td> {{ $th->ho_va_ten }}</td>
                                                        <td>
                                                            {{ $th->getTenThanh($th->ten_thanh_id) }}
                                                        </td>
                                                        <td>
                                                            {{ $th->ten_dong }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}</td>
                                                        <td>@if($th->giao_xu_id)
                                                                Giáo hạt: {{ $th->giaoHat->ten_giao_hat }}
                                                                <br>
                                                                Giáo xứ:
                                                                {{ $th->giaoXu->ten_giao_xu }}
                                                                @else
                                                                Không
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a type="button"
                                                               href="{{ route('tu-si.edit', $th)}}"
                                                               class="btn btn-sm btn-primary mb-1">
                                                                <i class="la la-pencil"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
    </div>
@endsection