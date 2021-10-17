<div wire:ignore.self class="modal fade" id="updateNgayMat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Cập nhập ngày mất</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label ">Ngày mất</label>
                    <input type="date" class="form-control"
                           wire:model="ngay_mat"
                    >
                </div>
                @if($errors->has('ngay_mat'))
                    <span class="text-danger font-weight-bold">{{ $errors->first('ngay_mat') }}</span>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button"
                        wire:click.prevent="update_ngay_mat"
                        class="btn btn-outline-danger d-inline-block px-3">Cập nhập</button>
            </div>
        </div>
    </div>
</div>

@livewireScripts
<script type="text/javascript">
        window.livewire.on('update_ngay_mat', () => {
            $('#updateNgayMat').modal('hide');
        });
</script>