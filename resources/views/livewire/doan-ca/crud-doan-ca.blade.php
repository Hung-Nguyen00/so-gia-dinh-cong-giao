<div>
    @include('doan_ca.add')
    @include('doan_ca.edit')
    @include('doan_ca.delete')
    <div class="card-header d-flex flex-wrap">
        <div class="col-md-12 col-xl-12 col-sm-12 d-flex justify-content-between">
            <h4 class="card-title">Danh sách các ca đoàn</h4>
            <div>
                <button
                        data-toggle="modal" wire:click="cancel" data-target="#add"
                        class="btn btn-primary">Thêm ca đoàn
                </button>
            </div>
        </div>
        <div class="col-md-6 col-xl-6 col-sm-6">
            <h4>Tìm kiếm</h4>
            @if(\Auth::user()->quanTri->ten_quyen == 'admin')
                <div>
                    <label>Chọn giáo xứ</label>
                    <select data-live-search="true" class="selectpicker  w-auto select form-control" wire:model="giao_xu_id">
                        @foreach($all_giao_xu as $t)
                            <option value="{{ $t->id }}"> {{ 'GH: '. $t->giaoHat->ten_giao_hat . ' - '. 'GX: '. $t->ten_giao_xu }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="d-flex mt-1">
                <div class="form-group">
                    <label>Tên ca đoàn</label>
                    <input type="text" wire:model="ten_ca_doan" class="form-control" placeholder="Nhập tên ca đoàn">
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
    </div>

    <div  class="card-body">
        <div class="table-responsive">
            <table class="table" style="min-width: 1080px;">
                <thead>
                <tr>
                    <th class="text-center" style="width: 100px">STT</th>
                    <th>Tên thánh bổn mạng</th>
                    <th>Tên ca đoàn</th>
                    <th>Ngày mừng bổn mạng</th>
                    <th>Trưởng ca đoàn</th>
                    <th>Số lượng thành viên</th>
                    <th>Thêm thành viên</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @if($all_doan_ca)
                    @foreach($all_doan_ca as $d)
                        <tr >
                            <td class="text-center"> {{ ++$i }}</td>
                            <td>
                                {{ $d->tenThanh->ten_thanh }}
                            </td>
                            <td>{{ $d->ten_doan_ca }}</td>
                            <td class="text-center">
                                @if($d->ngay_bon_mang)
                                    {{ \Illuminate\Support\Carbon::parse($d->ngay_bon_mang)->format('d-m-y') }}
                                @endif
                            </td>
                            <td>
                                @if($d->thanhVien)
                                    @foreach($d->thanhVien as $tv)
                                        {{ $tv->ho_va_ten }}
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $d->thanh_vien_count }}
                                <a href="{{ route('ca-doan-thanh-vien.index', $d) }}" class="text-primary">Xem chi tiết</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('ca-doan-thanh-vien-add.index', $d) }}"
                                   class="btn btn-success btn-sm d-inline-block mb-1">
                                    <i class="la la-plus"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button"
                                        wire:click="edit({{ $d->id }})"
                                        class="btn btn-sm btn-primary mb-1"
                                        data-toggle="modal"
                                        data-target="#edit">
                                    <i class="la la-pencil"></i>
                                </button>
                                <button type="button" wire:click="edit({{ $d->id }})"
                                        data-toggle="modal"
                                        data-target="#delete"
                                        class="btn btn-outline-danger btn-sm d-inline-block mb-1">
                                    <i class="la la-trash-o"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if($all_doan_ca)
            {{ $all_doan_ca->links()}}
            @endif
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