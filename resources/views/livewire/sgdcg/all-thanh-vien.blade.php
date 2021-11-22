<div>
    <div x-data="{
        ten_thanh: true,
        ho_va_ten: true,
        sinh_hoac_tu: false,
        }">
        <div class="col-md-3">
            <h4 class="font-weight-bold">Tìm kiếm</h4>
        </div>
        <div class="btn-group ml-3 pb-1">
            <a class="btn btn-sm btn-outline-primary" style="border-radius: 4px;" data-toggle="dropdown" href="#">
                Chọn kiểu lọc
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu p-2 w-100">
                <div class="custom-control custom-switch" >
                    <input type="checkbox" @click="ten_thanh = !ten_thanh" checked class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Tên thánh</label>
                </div>
                <div class="custom-control custom-switch mt-1">
                    <input type="checkbox" @click="ho_va_ten = !ho_va_ten" checked class="custom-control-input" id="customSwitch2">
                    <label class="custom-control-label" for="customSwitch2">Họ và tên</label>
                </div>
                <div class="custom-control custom-switch mt-1">
                    <input type="checkbox"  @click="sinh_hoac_tu = !sinh_hoac_tu" class="custom-control-input" id="customSwitch5">
                    <label class="custom-control-label" for="customSwitch5">Sinh hoặc tử</label>
                </div>
            </ul>
        </div>
        <div class="d-flex flex-wrap mb-3">
            @if(\Auth::user()->quanTri->ten_quyen == 'admin')
                <div class="col-md-3">
                    <label>Chọn giáo xứ</label>
                    <select data-live-search="true" class="selectpicker  select form-control" wire:model="giao_xu_id">
                        @foreach($all_giao_xu as $t)
                            <option value="{{ $t->id }}"> @if($t->giaoHat) {{ 'GH: '. $t->giaoHat->ten_giao_hat . ' - '. 'GX: '. $t->ten_giao_xu }}
                                @else
                                    {{'GX: '. $t->ten_giao_xu }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div x-show="ten_thanh" x-transition class="col-md-3 mb-1">
                <label>Tên thánh</label>
                <select data-live-search="true" class="selectpicker  select form-control" wire:model="ten_thanh_id">
                    <option value="" selected>Hiển thị tất cả</option>
                    @foreach($all_ten_thanh as $t)
                        <option value="{{ $t->id }}">{{ $t->ten_thanh }}</option>
                    @endforeach
                </select>
            </div>
            <div x-show="ho_va_ten" x-transition class="col-md-3 mb-1">
                <label>Họ và tên</label>
                <input type="text" wire:model.lazy="ho_va_ten" class="form-control">
            </div>
            <div x-show="sinh_hoac_tu" x-transition class="col-md-3 mb-1">
                <label>Sinh hoặc tử</label>
                <select class="form-control select" wire:model="sinh_or_tu">
                    <option value="null" selected>Hiển thị tất cả</option>
                    <option value="1">Sinh</option>
                    <option value="2">Tử</option>
                </select>
            </div>
            <div x-show="sinh_hoac_tu" x-transition class="col-md-3">
                <label>Ngày bắt đầu</label>
                <input type="date" wire:model.lazy="start_date" class="form-control">
            </div>
            <div x-show="sinh_hoac_tu" x-transition class="col-md-3">
                <label>Ngày kết thúc</label>
                <input type="date"  wire:model.lazy="end_date"  class="form-control">
            </div>
        </div>
        <div class="col-md-2 ">
            <label>Hiển thị</label>
            <select class="form-control select w-auto" wire:model="paginate_number">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20" selected>20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div  class="card-body">
            <div class="table-responsive">
                <table class="display table" style="min-width: 1180px; margin-top: -10px">
                    <thead>
                    <tr>
                        <th style="width: 50px">STT</th>
                        <th style="width: 100px">Tên thánh</th>
                        <th style="width: 150px">Họ và tên</th>
                        <th style="width: 110px">Ngày sinh</th>
                        <th style="width: 110px">Ngày mất</th>
                        <th style="width: 80px">Số điện thoại</th>
                        <th  style="width: 150px">Địa chỉ</th>
                        <th style="width: 100px">Sổ gia đình hiện tại</th>
                        <th style="width: 100px">Sổ gia đình gốc</th>
                        <th style="width: 50px">Xem chi tiết</th>
                    </tr>
                    </thead>
                    <tbody >
                    @php $i= 0; @endphp
                    @foreach($all_thanh_vien as $th)
                        <tr >
                            <td class="text-center"> {{ ++$i }}</td>
                            <td>
                                {{ $th->tenThanh->ten_thanh }}
                            </td>
                            <td class="text-break"> {{ $th->ho_va_ten }}</td>
                            <td>
                                @if(\Carbon\Carbon::parse($th->ngay_sinh)->format('d-m') == '01-01' && strtotime($th->ngay_sinh) < strtotime(1980))
                                    {{ \Carbon\Carbon::parse($th->ngay_sinh)->format('Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}
                                @endif
                            </td>
                            <td>
                                {{ $th->ngay_mat ? \Carbon\Carbon::parse($th->ngay_mat)->format('d-m-Y') : '' }}
                            </td>
                            <td>
                                {{ $th->so_dien_thoai }}
                            </td>
                            <td class="text-break">
                                {{ $th->dia_chi_hien_tai}}
                            </td>
                            @if($th->soGiaDinh2)
                            <td class="text-center">
                                <a href="{{ route('so-gia-dinh.show', $th->soGiaDinh2)}}" class="text-primary">Xem </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('so-gia-dinh.show', $th->soGiaDinh)}}" class="text-primary">Xem </a>
                            </td>
                            @else
                                <td class="text-center">
                                    <a href="{{ route('so-gia-dinh.show', $th->soGiaDinh)}}" class="text-primary">Xem </a>
                                </td>
                                <td class="text-center">

                                </td>
                            @endif
                            <td class="text-center">
                                <a type="button"
                                   href="{{ route('so-gia-dinh.editTV', ['sgdId' => $th->soGiaDinh->id, 'tvId' => $th->id]) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="la la-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex col-md-12 justify-content-end">
                    {{ $all_thanh_vien->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
        $(document).on('click', '.dropdown-menu', function(e) {
           e.stopPropagation();
        });
    </script>
@endpush