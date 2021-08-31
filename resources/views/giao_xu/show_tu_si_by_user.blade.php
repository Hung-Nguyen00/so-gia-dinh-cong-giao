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
                        <h4>Các tu sĩ</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý giáo xứ</a></li>
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
                                        <h4 class="card-title">Danh sách các tu sĩ</h4>
                                        <div class="d-flex justify-content-around">
                                            <a class="btn btn-primary" href="{{ route('giaoXu.createTuDong') }}">Thêm tu sĩ thuộc tu dòng</a>
                                        </div>
                                    </div>
                                    <div  class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th >STT</th>
                                                    <th>Họ và tên</th>
                                                    <th>Tên thánh</th>
                                                    <th style="width: 100px">Ngày sinh</th>
                                                    <th>Tên dòng</th>
                                                    <th>Chức vụ</th>
                                                    <th>Vị trí</th>
                                                    <th>Chỉnh sửa</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                                                @php $i= 0; @endphp
                                                @foreach($all_tu_si as $th)
                                                    <tr >
                                                        <td class="text-center"> {{ ++$i }}</td>
                                                        <td> {{ $th->ho_va_ten }}</td>
                                                        <td>
                                                            {{ $th->tenThanh->ten_thanh }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}</td>
                                                        <td>
                                                            {{ $th->nhaDong ? $th->nhaDong->ten_nha_dong : '' }}
                                                        </td>
                                                        <td>
                                                            @if($th->chucVu)
                                                                {{ $th->chucVu->ten_chuc_vu }}
                                                                @endif
                                                        </td>
                                                        <td>
                                                            @if($th->viTri)
                                                                {{$th->viTri->ten_vi_tri }}
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if($th->ten_dong !== null)
                                                            <a type="button"
                                                               href="{{ route('giaoXu.editTuDong', $th)}}"
                                                               class="btn btn-sm btn-primary mb-1">
                                                                <i class="la la-pencil"></i>
                                                            </a>
                                                                @else
                                                            <a type="button"
                                                               href="{{ route('tu-si.edit', $th)}}"
                                                               class="btn btn-sm btn-primary mb-1">
                                                                <i class="la la-pencil"></i>
                                                            </a>
                                                            @endif
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