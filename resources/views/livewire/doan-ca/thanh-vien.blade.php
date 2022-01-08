<div>
    @include('doan_ca.edit_thanh_vien')
    @include('doan_ca.delete_thanh_vien')
    <div class="card-header d-flex flex-wrap">
        <div class="col-md-12 col-xl-12 col-sm-12 d-flex justify-content-between">
            <h4 class="card-title">Danh sách các thành viên</h4>
            <div>
                <a href="{{ route('ca-doan-thanh-vien-add.index', $ca_doan) }}"
                   class="btn btn-primary">Thêm thành viên
                </a>
            </div>
        </div>

    </div>
    <div class="card-body" style="margin-top: -10px">
        <div class="col-md-6 col-xl-6 col-sm-6">
            <h4>Tìm kiếm</h4>
            <div class="d-flex">
                <div class="form-group">
                    <label>Tên thành viên</label>
                    <input type="text" wire:model="ten_thanh_vien" class="form-control"
                           placeholder="Nhập tên thành viên">
                </div>
                <div class="form-group d-flex align-items-end ml-2">
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
                    <th class="text-center">Chức vụ</th>
                    <th class="text-center">Thông tin</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_thanh_vien as $d)
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
                            @if($d->truong_doan == 1)
                                <button wire:click="toggleTruongDoan({{ $d->tvdc_id }})" class="btn btn-danger btn-sm">
                                    Trưởng
                                </button>
                            @else
                                <button wire:click="toggleTruongDoan({{ $d->tvdc_id }})" class="btn btn-success btn-sm">
                                    Thành viên
                                </button>
                            @endif
                        </td>
                        <td class="text-center">
                            <a type="button"
                               href="{{ route('so-gia-dinh.editTV', ['sgdId' => $d->sdg_id, 'tvId' => $d->tv_id]) }}"
                               class="btn btn-sm btn-primary">
                                <i class="la la-pencil"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" wire:click="edit({{ $d->tv_id }})"
                                    data-toggle="modal"
                                    data-target="#delete"
                                    class="btn btn-outline-danger btn-sm d-inline-block mb-1">
                                <i class="la la-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $all_thanh_vien->links()}}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });


    </script>
    <script type="text/javascript">
        window.livewire.on('edit', () => {
            $('#edit').modal('hide');
        });
        window.livewire.on('add', () => {
            $('#add').modal('hide');
        });
        window.livewire.on('delete', () => {
            $('#delete').modal('hide');
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
@endpush