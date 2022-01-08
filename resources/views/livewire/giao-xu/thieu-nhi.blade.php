<div>
    <div class="card-header d-flex flex-wrap">
        <div class="col-md-12">
            <h4 class="font-weight-bold">Danh sách các thiếu nhi</h4>
            @if(\Auth::user()->quanTri->ten_quyen == 'admin')
                <div>
                    <label>Chọn giáo xứ</label>
                    <select data-live-search="true" class="selectpicker w-auto select form-control"
                            wire:model="giao_xu_id">
                        @foreach($all_giao_xu as $t)
                            <option value="{{ $t->id }}"> {{ 'GH: '. $t->giaoHat->ten_giao_hat . ' - '. 'GX: '. $t->ten_giao_xu }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
        <div class="col-md-3 mt-3">
            <label>Xem theo cấp bậc thiếu nhi</label>
            <select class="selectpicker  select form-control" wire:model="select_level">
                <option value="chien_non">Chiên non</option>
                <option value="au_nhi">Ấu nhi</option>
                <option value="thieu_nhi">Thiếu nhi</option>
                <option value="nghia_si">Nghĩa sĩ</option>
                <option value="hiep_si">Hiệp sĩ</option>
            </select>
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
            <input type="text" wire:model.lazy="ho_va_ten" class="form-control">
        </div>
        <div class="col-md-3 mt-3">
            <label>Ngày sinh</label>
            <input type="date" wire:model.lazy="ngay_sinh" class="form-control">
        </div>
        <div class="col-md-2 mt-3">
            <div class="align-items-end mt-3">
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
    <div class="card-body">
        <div class="table-responsive">
            <table class="display table" style="width: 100%; margin-top: -10px">
                <thead>
                <tr>
                    <th style="width: 50px">STT</th>
                    <th>Tên thánh</th>
                    <th>Họ và tên</th>
                    <th style="width: 100px">Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th style="width: 100px">Thông tin <br> gia đình</th>
                    <th style="width: 150px" class="text-center">Thông tin <br> thành viên</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($showing_follow_level as $th)
                    <tr>
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
                            {{ $th->so_dien_thoai }}
                        </td>
                        <td class="text-break">
                            {{ $th->dia_chi_hien_tai}}
                        </td>
                        <td class="text-center">
                            @if($th->soGiaDinh)
                                <a href="{{ route('so-gia-dinh.show', ['so_gia_dinh' => $th->soGiaDinh ])}}"
                                   class="text-primary">Xem</a>
                            @endif
                        </td>

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
                {{ $showing_follow_level->links()}}
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });

    </script>
@endpush