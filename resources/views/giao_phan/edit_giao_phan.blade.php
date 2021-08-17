<div>
    <div wire:ignore.self class="modal fade" id="editGiaoPhan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa giáo phận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="giao_phan">Tên giáo phận</label>
                            <input type="text" wire:model="ten_giao_phan" class="form-control" placeholder="Nhập tên giáo phận">
                            @if($errors->has('ten_giao_phan'))
                                <span class="text-danger">{{ $errors->first('ten_giao_phan') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label >Địa chỉ</label>
                            <input type="text" wire:model="dia_chi" class="form-control" placeholder="Nhập địa chỉ giáo phận">
                            @if($errors->has('dia_chi'))
                                <span class="text-danger">{{ $errors->first('dia_chi') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label >Ngày thành lập</label>
                            <input type="date" wire:model="ngay_thanh_lap" class="form-control">
                            @if($errors->has('ngay_thanh_lap'))
                                <span class="text-danger">{{ $errors->first('ngay_thanh_lap') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label >Giáo tỉnh</label>
                            <select class="custom-select form-control mb-3" name="giao_tinh_id" wire:model="giao_tinh_id">
                                <option selected>Chọn giáo tỉnh</option>
                                @foreach($giao_tinh as $gt)
                                    <option value="{{ $gt->id }}"> {{ $gt->ten_giao_tinh }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('giao_tinh_id'))
                                <span class="text-danger">{{ $errors->first('giao_tinh_id') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Lưu lại</button>
                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
