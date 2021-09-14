<div>
    <div class="card-body">
            <h4 class="font-weight-bold">Tìm kiếm</h4>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-lg-3 pt-2 col-md-3 col-sm-6">
                    <label>Tên thánh</label>
                    <select data-live-search="true" class="selectpicker  select form-control" wire:model="ten_thanh_id">
                        <option value="" selected>Hiển thị tất cả</option>
                        @foreach($all_ten_thanh as $t)
                            <option value="{{ $t->id }}">{{ $t->ten_thanh }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 pt-2 col-md-3 col-sm-6">
                    <label>Họ và tên</label>
                    <input type="text" wire:model="ho_va_ten" class="form-control">
                </div>
                <div class="col-lg-3 pt-2 col-md-3 col-sm-6">
                    <label>Ngày sinh</label>
                    <input type="date" wire:model="date_of_birth" class="form-control">
                </div>
                <div class="col-lg-3 pt-2 col-md-3 col-sm-6">
                    <lable class="col-form-label">Chức vụ</lable>
                    <select class="selectpicker select form-control pt-2" wire:model="chuc_vu_id" name="chuc_vu_id">
                        <option  value=""  selected>Hiển thị tất cả</option>
                        @foreach($all_chuc_vu as $cv)
                            <option  value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                        @endforeach
                    </select>
                </div>
                @if(\Auth::user()->quanTri->ten_quyen === 'admin')
                <div class="col-lg-3 pt-2 col-md-3 col-sm-6 pt-3">
                    <lable class="col-form-label">Giáo phận</lable>
                    <select class="selectpicker select form-control pt-2" wire:change="changeGiaoPhan" wire:model="giao_phan_id" >
                        <option  value=""  selected>Hiển thị tất cả</option>
                        @foreach($all_giao_phan as $cv)
                            <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-lg-3 pt-3 col-md-3 col-sm-6">
                    <lable class="col-form-label">Giáo hạt</lable>
                    <select class="selectpicker select form-control pt-2" wire:model="giao_hat_id" >
                        <option  value=""  selected>Hiển thị tất cả</option>
                        @foreach($all_giao_hat as $cv)
                            <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_hat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 pt-3 col-md-3 col-sm-6">
                    <lable class="col-form-label">Giáo xứ</lable>
                    <select class="selectpicker select form-control pt-2" wire:model="giao_xu_id">
                        <option value="" selected>Hiển thị tất cả</option>
                        @foreach($all_giao_xu as $cv)
                            <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 pt-3 col-md-3 col-sm-6">
                    <lable class="col-form-label">Tên dòng</lable>
                    <select class="selectpicker select form-control pt-2" wire:model="nha_dong_id">
                        <option value="" selected>Hiển thị tất cả</option>
                        @foreach($all_nha_dong as $cv)
                            <option  value="{{ $cv->id }}"> {{ $cv->ten_nha_dong }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 pt-2 col-md-2 col-sm-2">
                    <label class="col-form-label w-100 d-inline-block">Hiển thị</label>
                    <select class="form-control selectpicker w-auto select" wire:model="paginate_number">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table display" style="min-width: 1080px;  margin-top: 10px">
                <thead>
                <tr>
                    <th style="width: 20px;" >STT</th>
                    <th>Tên thánh</th>
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    <th>Ngày tử</th>
                    <th>Du học</th>
                    <th>Đang phục vụ</th>
                    <th class="text-center">Chuyển công tác</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_tu_si as $th)
                    <tr >
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>
                            {{ $th->tenThanh->ten_thanh }}
                        </td>
                        <td> {{ $th->ho_va_ten }}</td>
                        <td>{{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}</td>
                        <td>@if($th->ngay_tu)
                                {{ \Carbon\Carbon::parse($th->ngay_tu)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td>
                            @if($th->dang_du_hoc == 1)
                                <span class="badge badge-rounded badge-success">Du học</span>
                            @endif
                        </td>
                        <td>
                            @if($th->giao_xu_id)
                                Giáo hạt: {{ $th->giaoHat->ten_giao_hat }}
                                <br>
                                Giáo xứ: {{ $th->giaoXu->ten_giao_xu }}
                            @else

                            @endif
                        </td>
                        <td class="text-center">
                            <a type="button"
                               href="{{ route('tu-si.editCongTac', $th)}}"
                               class="btn btn-sm btn-primary mb-1">
                                <i class="la la-pencil"></i>
                            </a>
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
            <div class="d-flex col-md-12 justify-content-end">
                {{ $all_tu_si->links()}}
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endsection