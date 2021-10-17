<div>
    <form wire:submit.prevent="update" method="post">
        <div class="row">
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <div>
                        <lable class="form-label ">Tên thánh</lable>
                        <select class="select  form-control pt-2" value="{{ old('ten_thanh_id')}}" wire:model="ten_thanh_id" data-live-search="true" >
                            <option value="" selected>Chọn tên thánh</option>
                            @foreach($all_ten_thanh as $cv)
                                <option  value="{{ $cv->id }}"> {{ $cv->ten_thanh }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($errors->has('ten_thanh_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_id') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Họ và tên</label>
                    <input type="text" class="form-control"
                           wire:model="ho_va_ten">
                </div>
                @if($errors->has('ho_va_ten'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('ho_va_ten') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label ">Chức vụ</lable>
                        <select class="select  form-control pt-2"  value="{{ old('chuc_vu_id') }}" wire:model="chuc_vu_id" data-live-search="true" >
                            @foreach($all_chuc_vu as $cv)
                                @if($cv->id === $tu_si->chuc_vu_id)
                                    <option selected value="{{ $cv->id }}"> {{ $cv->ten_chuc_vu }}</option>
                                @else
                                    <option  value="{{ $cv->id }}" {{ old('chuc_vu_id') == $cv->id ? 'selected' : '' }} > {{ $cv->ten_chuc_vu }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($errors->has('chuc_vu_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_id') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label">Chức vị</lable>
                        <select class="select form-control pt-2" wire:model="la_tong_giam_muc">
                            <option selected value=""> Chọn tên chức vị</option>
                            <option value="T" {{ old('la_tong_giam_muc') == 'T' || $tu_si->la_tong_giam_muc == 'T'  ? 'selected' : '' }}>
                                Tổng giám mục</option>
                            <option value="P" {{ old('la_tong_giam_muc') == 'P'|| $tu_si->la_tong_giam_muc == 'P'  ? 'selected' : '' }}>
                                Giám mục phụ tá</option>
                            <option value="Q" {{ old('la_tong_giam_muc') == 'Q'|| $tu_si->la_tong_giam_muc == 'Q'  ? 'selected' : '' }}>
                                Cha quản hạt</option>
                        </select>
                    </div>
                </div>
                @if($errors->has('la_tong_giam_muc'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('la_tong_giam_muc')}}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Email</label>
                    <input type="text" class="form-control"
                           value="{{ old('email') ?? $tu_si->email }}"
                           wire:model="email"
                    >
                </div>
                @if($errors->has('email'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label">Giới tính</lable>
                        <select class="select form-control pt-2" wire:model="gioi_tinh">
                            <option selected value="">Chọn giới tính</option>
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    </div>
                </div>
                @if($errors->has('gioi_tinh'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('gioi_tinh') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Ngày nhận chức</label>
                    <input type="date" class="form-control"
                           value="{{ old('ngay_nhan_chuc') ?? $tu_si->ngay_nhan_chuc  }}"
                           wire:model="ngay_nhan_chuc"
                    >
                </div>
                @if($errors->has('ngay_nhan_chuc'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('ngay_nhan_chuc') }}</span>
                @endif
            </div>

            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Nơi nhận chức</label>
                    <input type="text" class="form-control"
                           value="{{ old('noi_nhan_chuc') ?? $tu_si->noi_nhan_chuc }}"
                           wire:model="noi_nhan_chuc"
                    >
                </div>
                @if($errors->has('noi_nhan_chuc'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('noi_nhan_chuc') }}</span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label">Tên dòng (nếu thuộc nhà dòng)</label>
                    <select class="select form-control pt-2"
                            wire:model="nha_dong_id"
                            data-live-search="true" >
                        <option selected value="">Chọn tên nhà dòng</option>
                        @foreach($all_nha_dong as $cv)
                            <option  value="{{ $cv->id }}"
                                    {{ old('nha_dong_id') == $cv->id || $tu_si->nha_dong_id == $cv->id ? 'selected' : '' }}>
                                {{ $cv->ten_nha_dong }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if($errors->has('nha_dong_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('nha_dong_id') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Ngày sinh</label>
                    <input type="date" class="form-control "
                           value="{{ old('ngay_sinh') ?? $tu_si->ngay_sinh }}"
                           wire:model="ngay_sinh"
                    >
                </div>
                @if($errors->has('ngay_sinh'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('ngay_sinh') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Ngày mất</label>
                    <input type="date" class="form-control "
                           wire:model="ngay_mat"
                    >
                </div>
                @if($errors->has('ngay_mat'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('ngay_mat') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Số điện thoại</label>
                    <input type="tel" class="form-control "
                           value="{{ old('so_dien_thoai') ?? $tu_si->so_dien_thoai }}" wire:model="so_dien_thoai">
                </div>
                @if($errors->has('so_dien_thoai'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Địa chỉ</label>
                    <input type="text" class="form-control"
                           value="{{ old('dia_chi_hien_tai') ?? $tu_si->dia_chi_hien_tai }} " wire:model="dia_chi_hien_tai">
                </div>
                @if($errors->has('dia_chi_hien_tai'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('dia_chi_hien_tai') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label ">Giáo phận</lable>
                        <select class="select form-control pt-2"
                                wire:model="giao_phan_id"
                                data-live-search="true" >
                            @foreach($all_giao_phan as $cv)
                                @if($cv->id === $tu_si->giao_phan_id)
                                    <option selected value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }} - Giáo tỉnh: {{ $cv->giaoTinh->ten_giao_tinh }} </option>
                                @else
                                    <option {{ old('giao_phan_id') == $cv->id ? 'selected' : '' }}   value="{{ $cv->id }}"> {{ $cv->ten_giao_phan }} - Giáo tỉnh: {{ $cv->giaoTinh->ten_giao_tinh }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($errors->has('giao_phan_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('giao_phan_id') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mb-2 col-md-6 col-sm-12 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox"
                           wire:model.defer="dang_du_hoc"
                            class="form-check-input ">
                    <label class="form-check-label">Đang du học</label>
                </div>
            </div>
            <div class="col-lg-12 mt-2 col-md-12 col-sm-12 mt-3">
                <div id="cong_tac" class="form-group ">
                    <h5 class="font-weight-bold">Chuyển nhiệm sở mới</h5>
                </div>
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label ">Giáo hạt</lable>
                        <select wire:model="giao_hat_id"
                                data-live-search="true"
                                class="select form-control pt-2">
                            <option selected value="">Chọn tên giáo hạt</option>
                            @if($all_giao_hat)
                                @foreach($all_giao_hat as $cv)
                                    <option value="{{ $cv->id }}"> {{ $cv->ten_giao_hat }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @if($errors->has('giao_hat_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('giao_hat_id') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label ">Giáo xứ</lable>
                        <select class="select form-control pt-2"
                                data-live-search="true"
                                wire:model="giao_xu_id">
                            <option selected value="">Chọn tên giáo xứ</option>
                            @if($all_giao_xu)
                                @foreach($all_giao_xu as $cv)
                                    <option value="{{ $cv->id }}"> {{ $cv->ten_giao_xu }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @if($errors->has('giao_xu_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('giao_xu_id') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label">Vị trí phục vụ giáo xứ</lable>
                        <select class="select form-control pt-2"
                                data-live-search="true"
                                wire:model="vi_tri_id">
                            <option selected value="">Chọn tên vị trí phục vụ của giáo xứ</option>
                            @foreach($all_vi_tri as $cv)
                                <option value="{{ $cv->id }}"> {{ $cv->ten_vi_tri }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($errors->has('vi_tri_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('vi_tri_id') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label">Ngày bắt đầu nhiệm sở mới</label>
                    <input type="date" class="form-control "
                           value="{{ old('bat_dau_phuc_vu') ?? $tu_si->bat_dau_phuc_vu }}"
                           wire:model="bat_dau_phuc_vu"
                    >
                </div>
                @if($errors->has('bat_dau_phuc_vu'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('bat_dau_phuc_vu') }}</span>
                @endif
            </div>
            <div class="col-lg-12 mt-2 col-md-12 col-sm-12 mt-3">
                <div id="cong_tac" class="form-group ">
                    <h5 class="font-weight-bold">Kết thúc nhiệm sở cũ</h5>
                </div>
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label">Ngày kết thúc nhiệm sở cũ</label>
                    <input type="date" class="form-control "
                           value="{{ old('ket_thuc_phuc_vu') ?? $tu_si->ket_thuc_phuc_vu }}"
                           wire:model="ket_thuc_phuc_vu"
                    >
                </div>
                @if($errors->has('ket_thuc_phuc_vu'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('ket_thuc_phuc_vu') }}</span>
                @endif
            </div>
            <div class="col-lg-12 col-md-12 col-sm-6 mt-3">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary mr-2">Cập nhập thông tin</button>
                    <button type="button"  wire:click.prevent="endNhiemSo()" class="btn btn-info mr-2">Kết thúc nhiệm sở cũ</button>
                    <button type="button" wire:click.prevent="startNhiemSo()" class="btn btn-info mr-2">Chuyển nhiệm sở mới</button>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('tu-si.destroy', $tu_si) }}" style="margin-top: -36px;" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
                onclick="return window.confirm('Bạn chắc chắn muốn xóa tu sĩ này chứ?')"
                class="btn btn-outline-danger d-inline-block px-3 float-right">Xóa tu sĩ</button>
    </form>
</div>

@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endpush