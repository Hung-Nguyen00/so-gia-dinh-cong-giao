<div>
    @include('sgdcg.add_giao_phan')
    @include('sgdcg.edit_giao_phan')
    @include('sgdcg.delete_giao_phan')
    @include('sgdcg.edit_sgdcg')
    @include('sgdcg.show_history')
    @include('sgdcg.import')
    <div class="card-header pt-2 pb-0">
        <h4 class="card-title">Danh sách các sổ gia đình công giáo </h4>
        <div>
            <a href="{{ route('sgdcg-file-export', ['name' => 'sgdcg'])}}"
                    class="btn btn-info mt-1">Excel mẫu
            </a>
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-info mt-1">Import dữ liệu
            </button>
            <button
                    data-toggle="modal" wire:click="setCurrentTime" data-target="#createModal"
                    class="btn btn-primary mt-1">Thêm mới
            </button>
        </div>
    </div>
    <div  class="card-body">
        <div class="table-responsive">
            <h5>Tìm kiếm</h5>
            @if(\Auth::user()->quanTri->ten_quyen == 'admin')
            <div class="col-md-3">
                <label>Chọn giáo xứ</label>
                <select data-live-search="true" class="selectpicker  select form-control" wire:model="gx_id_search">
                    @foreach($all_giao_xu_search as $t)
                        <option value="{{ $t->id }}"> {{ 'GH: '. $t->giaoHat->ten_giao_hat . ' - '. 'GX: '. $t->ten_giao_xu }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="d-flex flex-wrap ">
                <div class="form-group col-md-3 ">
                    <label for="">Giáo họ</label>
                    <select class="form-control select" wire:model="giao_ho_id">
                        <option value="" selected >Tất cả</option>
                       @foreach($all_giao_ho as $gh)
                            <option value="{{ $gh->id }}">{{ $gh->ten_giao_xu }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>
                        Tên thánh
                    </label>
                    <select class="form-control select " data-live-search="true" wire:model="search_ten_thanh_id">
                        <option value="" selected>Chọn tên thánh</option>
                        @foreach($all_ten_thanh as $t)
                            <option value="{{ $t->id }}">{{$t->ten_thanh }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Chủ hộ</label>
                    <input type="text" wire:model.lazy="ten_chu_ho" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>
                        Chuyển xứ hoặc nhập xứ
                    </label>
                    <select class="form-control select" wire:model="chuyen_xu_nhap_xu">
                        <option value="1" selected>Tất cả</option>
                        <option value="2">Nhập xứ</option>
                        <option value="3">Chuyển xứ</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Ngày lập sổ</label>
                   <div class="d-flex flex-wrap justify-content-start">
                       <input type="date" wire:model.lazy="start_date" class="form-control mr-2 w-auto">
                       <span style="font-size: 20px" class="font-weight-bold"> - </span>
                       <input type="date" wire:model.lazy="end_date" class="ml-2 form-control w-auto">
                   </div>
                </div>

                <div class="form-group col-md-2 d-flex align-items-end">
                    <label class="mr-2">Hiển thị</label>
                    <select class="form-control select w-auto" wire:model="page_number">
                        <option value="5" >5</option>
                        <option value="10">10</option>
                        <option value="20" selected>20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
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
            <table class="table display" style="min-width: 1280px;">
                <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th>Mã sổ</th>
                    <th>Chủ hộ</th>
                    <th>Ngày tạo sổ</th>
                    <th class="text-center">Số lượng <br> thành viên</th>
                    <th>Thuộc</th>
                    <th>Đã nhập xứ</th>
                    <th class="text-center">Đã chuyển xứ</th>
                    <th>Lịch sử <br> chuyển xứ</th>
                    <th>Chuyển xứ</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @if($all_so_gia_dinh)
                @php $flag= 0; @endphp
                @foreach($all_so_gia_dinh as $g)
                    <tr>
                        <td class="text-center"> {{ ++$flag }}</td>
                        <td>{{ $g->ma_so }}</td>
                        <td>@if($g->thanhVien->count() > 0)
                                @foreach($g->thanhVien as $t)
                                    @if($t->tenThanh)
                                        {{ $t->tenThanh->ten_thanh . ' '. $t->ho_va_ten }}
                                    @else
                                        {{ $t->ho_va_ten }}
                                    @endif
                                    @break
                                @endforeach
                            @else
                                @if($g->thanhVienSo2)
                                    @foreach($g->thanhVienSo2 as $t)
                                        @if($t->tenThanh)
                                            {{ $t->tenThanh->ten_thanh . ' '. $t->ho_va_ten }}
                                        @else
                                            {{ $t->ho_va_ten }}
                                        @endif
                                        @break
                                    @endforeach
                                @endif
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($g->ngay_tao_so)->format('d-m-Y') }}</td>
                        <td class="text-center">{{ $g->thanh_vien_so2_count > 0 ? $g->thanh_vien_so2_count : $g->thanh_vien_count }}
                            <a  href="{{ route('so-gia-dinh.show', $g)  }}"> <i style="font-size: 20px; color: blue" class="la la-eye"></i></a>
                        <td>
                            @if($g->giaoXu)
                                @if($g->giaoXu->giao_xu_hoac_giao_ho == 0)
                                   Giáo xứ
                                @else
                                   Giáo họ: {{ $g->giaoXu->ten_giao_xu }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($g->la_nhap_xu == 1)
                                <span class="badge badge-rounded badge-success"> {{ \Carbon\Carbon::parse($ngay_tao_so)->format('d-m-Y') }}</span>
                            @endif
                            @if($g->giao_xu_id == \Auth::user()->giao_xu_id)
                                @if($g->lichSuChuyenXu->count() > 0)
                                    @php $i = 0; @endphp
                                    @foreach($g->lichSuChuyenXu as $ls)
                                        @php ++$i; @endphp
                                        @if($i == $g->lichSuChuyenXu->count())
                                            <span class="badge badge-rounded badge-success"> {{ \Carbon\Carbon::parse($ls->pivot->created_at)->format('d-m-Y') }}</span>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($g->giao_xu_id !== \Auth::user()->giao_xu_id)
                                @if($g->lichSuChuyenXu->count() > 0)
                                    @foreach($g->lichSuChuyenXu as $ls)
                                        @if($ls->pivot->giao_xu_id == \Auth::user()->giao_xu_id)
                                            <span class="badge badge-rounded badge-success"> {{ \Carbon\Carbon::parse($ls->pivot->created_at)->format('d-m-Y') }}</span>
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if($g->lichSuChuyenXu->count() > 0)
                                <button type="button"
                                        wire:click="getHistory({{ $g->id }})"
                                        class="btn btn-sm btn-primary mb-1"
                                        data-toggle="modal"
                                        data-target="#historySgdcg">
                                    <i class="la  fs-16 la-bookmark"></i>
                                </button>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="button"
                                    wire:click="edit({{ $g->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editModal">
                                <i class="la  fs-16 la-street-view"></i>
                            </button>
                        </td>
                        <td>
                            @if(\Auth::user()->giao_xu_id == $g->giao_xu_id)
                            <button type="button"
                                    wire:click="edit({{ $g->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editSgdcg">
                                <i class="la  fs-16 la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $g->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                    class="btn btn-outline-danger btn-sm d-inline-block mb-1">
                                <i class="la la-trash-o"></i>
                            </button>
                            @else
                                <button type="button"
                                        disabled
                                        class="btn btn-sm btn-primary mb-1"
                                        data-toggle="modal"
                                        data-target="#editSgdcg">
                                    <i class="la  fs-16 la-pencil"></i>
                                </button>
                                <button type="button"
                                        disabled
                                        data-toggle="modal"
                                        data-target="#deleteModal"
                                        class="btn btn-sm btn-danger mb-1">
                                    <i class="la la-trash-o"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                @if($all_so_gia_dinh)
                {{ $all_so_gia_dinh->links() }}
                @endif
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