<div>
    <div wire:ignore.self class="modal fade" id="giaoHatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới tên thánh </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="giao_xu">Tên tên thánh</label>
                            <input type="text" wire:model="ten_thanh" class="form-control" placeholder="Nhập tên tên thánh">
                            @if($errors->has('ten_thanh'))
                                <span class="text-danger">{{ $errors->first('ten_thanh') }}</span>
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