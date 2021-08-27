<div>
    <div class="card-header">
        <h4 class="card-title">Danh sách các tu sĩ </h4>
        <div class="d-flex justify-content-around">
            {{--<a class="btn btn-success" href="{{ route('GP-file-export') }}">Export data</a>--}}
        </div>
    </div>
    <form action="">
        <div class="col-md-12 d-flex justify-content-around ">
           <div class="d-flex col-md-8">
               <div class="form-group " style="margin-left: -60px;">
                   <div wire:ignore>
                       <lable class="col-form-label">Tìm kiếm tu sĩ theo chức vụ</lable>
                       <select class="selectpicker form-control pt-1" name="" data-live-search="true" >
                           @if($current_chuc_vu !== null)
                               <option selected  value="{{ $current_chuc_vu->id }}"> {{ $current_chuc_vu->ten_chuc_vu }}</option>
                           @endif
                           @foreach($all_chuc_vu as $cv)
                               <option  value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                           @endforeach
                       </select>
                   </div>
               </div>
               <div class="d-flex justify-content-center align-items-center">
                   <button class="mt-3 btn btn-sm btn-primary">Tìm kiếm</button>
               </div>
           </div>
            <div class="float">
                <button
                        data-toggle="modal" data-target="#giaoHatModal"
                        class="btn btn-primary">Thêm giáo tu sĩ
                </button>
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
                    <th>Ngày sinh</th>
                    <th>Du học</th>
                    <th>Thuộc giáo phận</th>
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
                        <td>{{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}</td>
                        <td>
                            @if($th->dang_du_hoc == 1)
                                <span class="badge badge-rounded badge-success">Đang du học</span>
                            @endif
                        </td>
                        <td>{{ $th->giaoPhan->ten_giao_phan }}</td>
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoHat">
                                <i class="la la-pencil"></i>
                            </button>
                            <button type="button"
                                    data-toggle="modal"
                                    data-target="#deleteGiaoHat"
                                    class="btn btn-outline-danger btn-sm d-inline-block mb-1">
                                <i class="la la-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>