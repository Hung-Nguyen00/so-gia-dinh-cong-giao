<div>
    @include('tu_si.upload_avatar')
    @include('tu_si.delete_tu_si')
    <div id="list-view" class="tab-pane fade active show col-lg-12">
        <div class="card">
            <div>
                <div class="card-header">
                    <h4 class="card-title">Danh sách các tu sĩ</h4>
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-primary" href="{{ route('giaoXu.createTuDong') }}">Thêm tu sĩ thuộc tu dòng</a>
                    </div>
                </div>
                <div style="padding-left: 20px">
                    @if($active)
                        <button class="btn btn-sm btn-outline-danger font-weight-bold" wire:click.prevent="changeView">
                            Xem bảng
                        </button>
                    @else
                        <button  wire:click.prevent="changeView" class="font-weight-bold btn btn-sm btn-outline-danger">
                            Xem dạng thẻ
                        </button>
                    @endif
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

                        <div class="col-md-3 col-lg-3 mt-3">
                            <label>Sinh hoặc tử</label>
                            <select class="form-control select" wire:model="sinh_hoac_tu">
                                <option value="null" selected>Hiển thị tất cả</option>
                                <option value="1">Sinh</option>
                                <option value="2">Tử</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label>Ngày bắt đầu</label>
                            <input type="date" wire:model="start_date" class="form-control">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label>Ngày kết thúc</label>
                            <input type="date"  wire:model="end_date"  class="form-control">
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
                    @if(!$active)
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
                    @else
                        <div class="col-lg-12">
                        <div class="row">
                                @foreach($all_tu_si as $th)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-profile" style="border: 1px solid gainsboro">
                                            <div class="card-header justify-content-end pb-0">
                                                <div class="dropdown">
                                                    <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                        <span class="dropdown-dots fs--1"></span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right border py-0">
                                                        <div class="py-2">
                                                            <a class="dropdown-item font-weight-bold" href="{{ route('tu-si.edit', $th)}}">Chỉnh sửa</a>
                                                            <button class="dropdown-item font-weight-bold"
                                                                    wire:click="edit({{ $th->id }})"
                                                                    data-toggle="modal" data-target="#uploadAvatar" >Đổi ảnh đại diện</button>
                                                            <button class="dropdown-item font-weight-bold text-danger"
                                                                    wire:click="edit({{ $th->id }})"
                                                                    data-toggle="modal" data-target="#deleteTuSi">Xóa</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body pt-2">
                                                <div class="text-center">
                                                    <div class="profile-photo">
                                                        @if($th->avatar)
                                                            <img class="rounded-circle"  style="width: 100px; height: 100px" src="{{ asset($th->avatar) }}" alt="{{ $th->ho_va_ten }}">
                                                        @else
                                                            @if($th->gioi_tinh == 1)
                                                                <img class="rounded-circle" style="width: 100px; height: 100px" src="{{ asset('images/tusi.jpg') }}" alt="{{ $th->ho_va_ten }}">
                                                            @else
                                                                <img class="rounded-circle" style="width: 100px; height: 100px" src="{{ asset('images/tusiNu.png') }}" alt="{{ $th->ho_va_ten }}">
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <h5 class="mt-4 mb-1">{{ $th->tenThanh->ten_thanh . ' '. $th->ho_va_ten }}</h5>
                                                    <p class="text-muted">{{ $th->chucVu->ten_chuc_vu }}</p>
                                                    <ul class="list-group mb-3 list-group-flush">
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span>Email</span><strong>{{ $th->email }}</strong></li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span>Số điện thoại</span><strong>{{ $th->so_dien_thoai }}</strong></li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span>Ngày nhận chức</span><strong>{{ \Carbon\Carbon::parse($th->ngay_nhan_chuc)->format('d-m-Y') }}</strong></li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Ngày sinh</span><strong>{{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}  </strong></li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Ngày mất</span><strong>
                                                                @if($th->ngay_mat)
                                                                    {{ \Carbon\Carbon::parse($th->ngay_mat)->format('d-m-Y') }}
                                                                @endif
                                                            </strong></li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span class="mb-0">Đang phục vụ</span><strong class="text-left">
                                                                @if($th->giao_xu_id)
                                                                    Giáo hạt: {{ $th->giaoHat->ten_giao_hat }}
                                                                    <br>
                                                                    @if($th->giaoXu->giao_xu_hoac_giao_ho !== 0)
                                                                        Giáo họ: {{ $th->giaoXu->ten_giao_xu }}
                                                                        @else
                                                                        Giáo xứ: {{ $th->giaoXu->ten_giao_xu }}
                                                                    @endif
                                                                @else
                                                                @endif</strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    @endif
                        <div class="d-flex col-md-12 justify-content-end">
                            {{ $all_tu_si->links()}}
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