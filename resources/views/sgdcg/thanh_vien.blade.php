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
                        <h4>Thông tin mã sổ <strong>{{ $soGiaDinh->ma_so }}</strong></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('so-gia-dinh.index') }}">Quản lý giáo xứ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('so-gia-dinh.show', $soGiaDinh)}}">Sổ gia đình công giáo</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thành viên</a></li>
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
                                        <h4 class="card-title">Danh sách các thành viên </h4>
                                        <div class="float-right">
                                            <a class="btn btn-primary"
                                               href="{{ route('so-gia-dinh.createTV', ['sgdId' => $soGiaDinh->id] )}}">Thêm thành viên
                                            </a>
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
                                                    <th>Ngày sinh</th>
                                                    <th>Chức vụ gia đình</th>
                                                    <th>Bí tích đã nhận</th>
                                                    <th>Thêm bí tích</th>
                                                    <th>Xem chi tiết</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                                                @php $i= 0; @endphp
                                                @foreach($all_thanh_vien as $th)
                                                    <tr >
                                                        <td class="text-center"> {{ ++$i }}</td>
                                                        <td> {{ $th->ho_va_ten }}</td>
                                                        <td>
                                                            {{ $th->tenThanh->ten_thanh }}
                                                        </td>
                                                        <td>
                                                            @if(\Carbon\Carbon::parse($th->ngay_sinh)->format('d-m') == '01-01' && strtotime($th->ngay_sinh) < strtotime(1980))
                                                                {{ \Carbon\Carbon::parse($th->ngay_sinh)->format('Y') }}
                                                            @else
                                                                {{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{ $th->chuc_vu_gd }}</td>
                                                        <td class="text-center">
                                                           {{ $th->bi_tich_count }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a type="button"
                                                               href="{{ route('so-gia-dinh.editBTTV', ['sgdId' => $soGiaDinh->id, 'tvId' => $th->id]) }}"
                                                               class="btn btn-sm btn-primary mr-2">
                                                                <i class="la la-pencil"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center d-flex justify-content-center">
                                                            <a type="button"
                                                               href="{{ route('so-gia-dinh.editTV', ['sgdId' => $soGiaDinh->id, 'tvId' => $th->id]) }}"
                                                               class="btn btn-sm btn-primary mr-2">
                                                                <i class="la la-pencil"></i>
                                                            </a>
                                                            <form action=" {{ route('so-gia-dinh.deleteTV', ['sgdId' => $soGiaDinh, 'id' => $th->id] ) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        onclick="return window.confirm('Bạn chắc chắn muốn xóa thành viên này chứ?')"
                                                                        class="btn btn-sm btn-danger mr-2 "><i class="text-white la la-trash-o"></i></button>
                                                            </form>
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