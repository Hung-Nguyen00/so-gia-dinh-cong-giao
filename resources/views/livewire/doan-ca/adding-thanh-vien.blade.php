<div>
    <div wire:ignore.self class="modal fade show" id="add" tabindex="-1" role="dialog"
         style="display: block; background-color: rgba(72,74,77, 0.4);  overflow-x: hidden; overflow-y: auto;"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 1080px !important;" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex flex-wrap">
                    <div class="col-md-12">
                        <h3>Tìm kiếm và thêm thành viên mới</h3>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label>Tên thánh</label>
                        <select data-live-search="true" class="selectpicker  select form-control" wire:model="ten_thanh_id">
                            <option value="" selected>Hiển thị tất cả</option>
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
                </div>
                <div wire:loading>
                    <div id="loadingAddTVSgdcg" class="la-ball-circus la-2x" style="top: 50% !important;">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div  class="card-body">
                        <div class="table-responsive">
                            <table class="table display" style="min-width: 600px">
                                <thead class="thead-primary">
                                <tr>
                                    <th class="text-center" >STT</th>
                                    <th class="text-center">Tên thánh</th>
                                    <th class="text-center" >Họ và tên</th>
                                    <th class="text-center" >Ngày sinh</th>
                                    <th class="text-center" >Số điện thoại</th>
                                    <th class="text-center">Thêm</th>
                                </tr>
                                </thead>
                                <tbody >
                                @php $i=0 @endphp
                                @if($all_tv_adding)
                                    @foreach($all_tv_adding as $tv)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td class="text-center">{{ $tv->ten_thanh }}</td>
                                            <td class="text-center">{{ $tv->ho_va_ten }}</td>
                                            <td class="text-center">
                                                @if($tv->ngay_sinh)
                                                    {{ \Illuminate\Support\Carbon::parse($tv->ngay_sinh)->format('d-m-y') }}
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $tv->so_dien_thoai }}</td>
                                            <td class="text-center">
                                                <button class="btn- btn-sm btn-primary">
                                                    <i class="la la-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{ $all_tv_adding->links() }}
                        </div>
                    </div>
                </div>
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