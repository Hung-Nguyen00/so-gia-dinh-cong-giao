<div>
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới sổ gia đình công giáo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form wire:submit.prevent="store">
                            <div class="form-group">
                                <label for="giao_phan">Mã sổ</label>
                                <input type="text" wire:model="ma_so" class="form-control" placeholder="Nhập mã sổ">
                                @if($errors->has('ma_so'))
                                    <span class="text-danger">{{ $errors->first('ma_so') }}</span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label >Ngày tạo sổ</label>
                                    <input type="date" wire:model="ngay_tao_so" class="form-control col-md-5">
                                @if($errors->has('ngay_tao_so'))
                                    <span class="text-danger">{{ $errors->first('ngay_tao_so') }}</span>
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