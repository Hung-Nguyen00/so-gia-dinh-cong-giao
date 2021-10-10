<div>
    <form wire:submit.prevent="store"  method="post" >
        @csrf
        <div class="row">
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <div>
                        <lable class="form-label ">Tên thánh</lable>
                        <select class="select form-control pt-2"
                                wire:model="ten_thanh_id"
                                data-live-search="true" >
                            <option selected value=""> Chọn tên thánh</option>
                            @foreach($all_ten_thanh as $cv)
                                <option  value="{{ $cv->id }}" > {{ $cv->ten_thanh }}</option>
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
                    <div style="margin-top: -10px">
                    <span class="text-danger font-weight-bold" >{{ $errors->first('ho_va_ten') }}</span>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label ">Chức vụ</lable>
                        <select class="select form-control pt-2"
                                wire:model="chuc_vu_id"
                                data-live-search="true" >
                            <option selected value=""> Chọn tên chức vụ</option>
                            @foreach($all_chuc_vu as $cv)
                                <option  value="{{ $cv->id }}" > {{ $cv->ten_chuc_vu }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($errors->has('chuc_vu_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('chuc_vu_id') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label">Chức vị</lable>
                        <select class="select form-control pt-2"
                                wire:model="la_tong_giam_muc">
                            <option selected value=""> Chọn tên chức vị</option>
                            <option value="T" {{ old('la_tong_giam_muc') == 'T' ? 'selected' : '' }}>Tổng giám mục</option>
                            <option value="P" {{ old('la_tong_giam_muc') == 'P' ? 'selected' : '' }}>Giám mục phụ tá</option>
                            <option value="Q" {{ old('la_tong_giam_muc') == 'Q' ? 'selected' : '' }}>Cha quản hạt</option>
                        </select>
                    </div>
                </div>
                @if($errors->has('la_tong_giam_muc'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('la_tong_giam_muc')}}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group ">
                    <div>
                        <lable class="form-label ">Giới tính</lable>
                        <select class="select form-control pt-2" wire:model="gioi_tinh">
                            <option value="">Chọn giới tính</option>
                            <option value="0">Nữ</option>
                            <option value="1">Nam</option>
                        </select>
                    </div>
                </div>
                @if($errors->has('gioi_tinh'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('gioi_tinh') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Email</label>
                    <input type="text" class="form-control"
                           wire:model="email"
                    >
                </div>
                @if($errors->has('email'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Ngày nhận chức</label>
                    <input type="date" class="form-control"
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
                            <option  value="{{ $cv->id }}">
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
                           value="{{ old('so_dien_thoai')}}" wire:model="so_dien_thoai">
                </div>
                @if($errors->has('so_dien_thoai'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
                @endif
            </div>
            <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-label ">Địa chỉ</label>
                    <input type="text" class="form-control"
                           value="{{ old('dia_chi_hien_tai')}}"
                           wire:model="dia_chi_hien_tai">
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
                            <option selected value="">Chọn tên giáo phận</option>
                            @foreach($all_giao_phan as $cv)
                                <option  value="{{ $cv->id }}">
                                    Giáo Tỉnh: {{ $cv->giaoTinh->ten_giao_tinh }} - GP: {{ $cv->ten_giao_phan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($errors->has('giao_phan_id'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('giao_phan_id') }}</span>
                @endif
            </div>
            <div class="col-lg-12 mt-2 col-md-12 col-sm-12">
                <div class="form-check ml-1">
                    <input type="checkbox" wire:model="dang_du_hoc" class="form-check-input">
                    <label class="form-check-label">Đang du học</label>
                </div>
            </div>
            <div class="col-lg-12 mt-3 col-md-12 col-sm-12">
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endpush