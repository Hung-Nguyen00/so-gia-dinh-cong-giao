<div>
    <div wire:ignore.self class="modal fade" id="editGiaoHat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa giáo xứ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="giao_hat">Tên giáo xứ</label>
                            <input type="text" wire:model="ten_giao_xu" class="form-control" placeholder="Nhập tên giáo xứ">
                            @if($errors->has('ten_giao_xu'))
                                <span class="text-danger">{{ $errors->first('ten_giao_xu') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label >Địa chỉ</label>
                            <input type="text" wire:model="dia_chi" class="form-control" placeholder="Nhập địa chỉ Giáo Hạt">
                            @if($errors->has('dia_chi'))
                                <span class="text-danger">{{ $errors->first('dia_chi') }}</span>
                            @endif
                        </div>
                        <div class="form-group ">
                            <label >Ngày thành lập</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="date" wire:model="ngay_thanh_lap" class="form-control col-md-5">
                                <label >Hoặc nhập năm:</label>
                                <input type="number" wire:model="nam_thanh_lap" class="form-control col-md-3">
                            </div>
                            @if($errors->has('ngay_thanh_lap'))
                                <span class="text-danger">{{ $errors->first('ngay_thanh_lap') }}</span>
                            @endif
                            @if($errors->has('nam_thanh_lap'))
                                <span class="text-danger">{{ $errors->first('nam_thanh_lap') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label >Giáo Hạt</label>
                            <select class="custom-select select form-control mb-3" name="giao_hat_id" data-live-search="true" wire:model="giao_hat_id">
                                <option selected>Chọn Giáo Hạt</option>
                                @foreach($giao_hat as $gt)
                                    <option value="{{ $gt->id }}"> {{ $gt->ten_giao_hat }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('giao_hat_id'))
                                <span class="text-danger">{{ $errors->first('giao_hat_id') }}</span>
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
