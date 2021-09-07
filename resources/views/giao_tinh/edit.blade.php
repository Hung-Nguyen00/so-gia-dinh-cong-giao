<div>
    <div wire:ignore.self class="modal fade" id="editGiaoPhan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa giáo tỉnh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="giao_tinh">Tên giáo tỉnh</label>
                            <input type="text" wire:model="ten_giao_tinh" class="form-control" placeholder="Nhập tên giáo tỉnh">
                            @if($errors->has('ten_giao_tinh'))
                                <span class="text-danger">{{ $errors->first('ten_giao_tinh') }}</span>
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
