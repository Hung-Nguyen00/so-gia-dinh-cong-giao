<div>
    <div wire:ignore.self class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm ca đoàn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="giao_xu">Tên ca đoàn</label>
                            <input type="text" wire:model="ten_doan_ca" class="form-control" placeholder="Nhập tên ca đoàn">
                            @if($errors->has('ten_doan_ca'))
                                <span class="text-danger">{{ $errors->first('ten_doan_ca') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tên bổn mạng</label>
                            <select data-live-search="true" class="selectpicker  select form-control" wire:model="ten_thanh_id">
                                <option value="" selected>Chọn tên bổn mạng</option>
                                @foreach($all_ten_thanh as $t)
                                    <option value="{{ $t->id }}">{{ $t->ten_thanh }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ten_thanh_id'))
                                <span class="text-danger">{{ $errors->first('ten_thanh_id')}}</span>
                            @endif
                        </div>
                        <div class="form-group ">
                            <label>Ngày bồn mạng</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="date" wire:model="ngay_bon_mang" class="form-control col-md-5">
                            </div>
                            @if($errors->has('ngay_bon_mang'))
                                <span class="text-danger">{{ $errors->first('ngay_bon_mang') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Thêm mới</button>
                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>