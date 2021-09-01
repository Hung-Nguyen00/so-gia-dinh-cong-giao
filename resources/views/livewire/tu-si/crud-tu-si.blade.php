<div>
    <div class="card-body">
            <h4 class="font-weight-bold">Tìm kiếm</h4>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-md-3">
                    <label>Tên thánh</label>
                    <select data-live-search="true" class="selectpicker select form-control" wire:model="ten_thanh_id">
                        <option value="" selected>Chọn tên thánh</option>
                        @foreach($all_ten_thanh as $t)
                            <option value="{{ $t->id }}">{{ $t->ten_thanh }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Họ và tên</label>
                    <input type="text" wire:model="ho_va_ten" class="form-control">
                </div>
                <div class="col-md-3">
                    <lable class="col-form-label">Tìm kiếm tu sĩ theo chức vụ</lable>
                    <select class="selectpicker select form-control pt-2" name="chuc_vu_id">
                        <option  value=""  selected> Chọn chức vụ</option>
                        @foreach($all_chuc_vu as $cv)
                            <option  value="{{ $cv->ten_chuc_vu }}"> {{ $cv->ten_chuc_vu }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Ngày bắt đầu</label>
                    <input type="date" wire:model="start_date" class="form-control">
                </div>
                <div class="col-md-3 mt-3">
                    <label>Ngày kết thúc</label>
                    <input type="date"  wire:model="end_date"  class="form-control">
                </div>
                <div class="col-md-2 mt-3">
                    <label>Hiển thị</label>
                    <select class="form-control" wire:model="paginate_number">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table display" style="min-width: 870px; width: 950px; margin-top: -10px">
                <thead>
                <tr>
                    <th style="width: 20px;" >STT</th>
                    <th>Họ và tên</th>
                    <th>Tên thánh</th>
                    <th style="width: 110px">Ngày sinh</th>
                    <th style="width:60px;">Du học</th>
                    <th style="width:170px;">Đang phục vụ</th>
                    <th  style="width:60px;">Chuyển công tác</th>
                    <th style="width:60px;">Chỉnh sửa</th>
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
        </div>
    </div>
</div>
