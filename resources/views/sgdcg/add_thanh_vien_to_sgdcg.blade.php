<div>
    <div wire:ignore.self class="modal fade" id="thanhVienModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm thành viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="giao_xu">Tên giáo phận</label>
                            <select class="select form-control selectpicker" wire:model="giao_phan_id" data-live-search="true">
                                <option value="" selected>Chọn giáo phận</option>
                                @foreach($all_giao_phan as $th)
                                    <option value="{{ $th->id }}"> {{ $th->ten_giao_phan }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Giáo xứ</label>
                            <select class="select form-control selectpicker" wire:model="giao_xu_id" data-live-search="true">
                                @if(!$giao_phan_id)
                                <option value="" selected>Không có dữ liệu</option>
                                    @else
                                <option value="" selected>Chọn giáo xứ</option>
                                @endif
                                @foreach($all_giao_xu as $th)
                                    <option value="{{ $th->id }}">GH: {{ $th->giaoHat->ten_giao_hat }} - {{ $th->ten_giao_xu }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex p-0">
                            <div class="col-md-6 p-0">
                                <label >Tên thánh</label>
                                <select class="select form-control selectpicker" wire:model="ten_thanh_id" data-live-search="true">
                                    <option value="" selected>Chọn tên thánh</option>
                                    @foreach($all_ten_thanh as $th)
                                        <option value="{{ $th->id }}"> {{ $th->ten_thanh }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 pr-0">
                                <label >Chức vụ gia đình</label>
                                <select class="select form-control selectpicker" wire:model="chuc_vu_gd">
                                    <option value="" selected>Chọn chức vụ</option>
                                    <option value="Cha">Cha</option>
                                    <option value="Mẹ">Mẹ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Ngày sinh</label>
                            <input type="date" class="form-control" wire:model="ngay_sinh">
                        </div>
                        <div class="form-group">
                            <label>Thành viên</label>
                            <select class="select form-control selectpicker" wire:model="thanh_vien_id" data-live-search="true">
                                <option value="" selected>Chọn thành viên</option>
                                @foreach($thanh_vien as $th)
                                    <option value="{{ $th->thanh_vien_id }}"> {{ $th->ho_va_ten }} </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Thêm mới</button>
                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>