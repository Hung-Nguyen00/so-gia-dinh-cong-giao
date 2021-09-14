<div>
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
                    <h4 class="font-weight-bold">Tìm kiếm</h4>
                    <div class="d-flex flex-wrap mb-3">
                        <div class="col-lg-3 pt-2 col-md-3 col-sm-6">
                            <label>Tên thánh</label>
                            <select data-live-search="true" class="selectpicker select form-control" wire:model="ten_thanh_id">
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
                        <div class="col-lg-3 pt-3 col-md-3 col-sm-6">
                            <lable class="col-form-label">Giáo họ</lable>
                            <select class="selectpicker select form-control pt-2" wire:model="giao_ho_id">
                                <option value="" selected>Hiển thị tất cả</option>
                                @foreach($all_giao_ho as $cv)
                                    <option  value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
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
                        <table class="table display" style="min-width: 950px">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ và tên</th>
                                <th>Tên thánh</th>
                                <th >Ngày sinh</th>
                                <th >Ngày tử</th>
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
                                    <td>@if($th->ngay_tu)
                                        {{ \Carbon\Carbon::parse($th->ngay_tu)->format('d-m-Y') }}
                                        @endif
                                    </td>
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

@push('scripts')
    <script type="text/javascript">
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endpush