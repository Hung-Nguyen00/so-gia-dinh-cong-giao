<div>
    <div class="card-header d-flex flex-wrap">
        <div class="col-md-12 col-xl-12 col-sm-12 d-flex justify-content-between">
            <h4 class="card-title">Danh sách giáo dân</h4>
            <div>
                <a
                        href="{{ route('ca-doan-thanh-vien.index', $ca_doan) }}"
                        class="btn btn-primary">Danh sách thành viên
                </a>
            </div>
        </div>
    </div>
    <div class="card-body" style="margin-top: -10px">
        <div class="col-md-12 col-xl-12 col-sm-12">
            <h4>Tìm kiếm</h4>
            <div class="d-flex flex-wrap">
                <div class="col-md-3 mt-3">
                    <label>Tên thánh</label>
                    <select data-live-search="true" class="selectpicker  select form-control" wire:model="ten_thanh_id">
                        <option value="" selected>Chọn tên thánh</option>
                        @foreach($all_ten_thanh as $t)
                            <option value="{{ $t->id }}">{{ $t->ten_thanh }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mt-3">
                    <label>Họ và tên</label>
                    <input type="text" wire:model="ho_va_ten" class="form-control">
                </div>
                <div class="col-md-3 mt-3">
                    <label>Ngày sinh</label>
                    <input type="date" wire:model="ngay_sinh" class="form-control">
                </div>
                <div class="col-md-3 mt-3">
                    <label>Số điện thoại</label>
                    <input type="text" wire:model="so_dien_thoai" class="form-control">
                </div>
                <div class="form-group mt-3 d-flex align-items-end ml-3">
                    <label>Hiển thị</label>
                    <select class="pl-2 form-control select w-auto" wire:model="paginate_number">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20" selected>20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table" style="width: 100%">
                <thead>
                <tr>
                    <th class="text-center" style="width: 100px">STT</th>
                    <th>Tên thánh</th>
                    <th>Họ và tên</th>
                    <th class="text-center">Ngày sinh</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center">Thêm</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_tv_adding as $d)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>
                            {{ $d->ten_thanh }}
                        </td>
                        <td>{{ $d->ho_va_ten }}</td>
                        <td class="text-center">
                            @if($d->ngay_sinh)
                                {{ \Illuminate\Support\Carbon::parse($d->ngay_sinh)->format('d-m-y') }}
                            @endif
                        </td>
                        <td class="text-center">
                            {{ $d->so_dien_thoai }}
                        </td>
                        <td class="text-center">
                            @if($tv_ca_doan)
                                @php $flag = 0 @endphp
                                @foreach($tv_ca_doan as $tv_id)
                                    @if($tv_id == $d->tv_id)
                                        @php $flag ++ @endphp
                                        <button type="button"
                                                wire:click="deleteThanhVien({{ $d->tv_id }})"
                                                class="btn btn-outline-danger d-inline-block btn-sm">
                                            <i class="la la-trash"></i>
                                        </button>
                                    @endif
                                @endforeach
                                @if($flag == 0)
                                    <button type="button"
                                            wire:click="addThanhVien({{ $d->tv_id }})"
                                            class="btn btn-primary btn-sm">
                                        <i class="la la-plus"></i>
                                    </button>
                                @endif
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $all_tv_adding->links()}}
        </div>
    </div>
</div>

@section('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });

    </script>
    <script>
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });

    </script>
@endsection