<div wire:ignore.self class="modal fade" id="deleteTuSi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xóa tu sĩ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading>
                <div id="loadingAddTVSgdcg" class="la-ball-circus la-2x" style="top: 30% !important;">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="modal-body">
                <h5 class="card-header" style="margin-top: -15px;">Bạn có chắc chắn muốn xóa tu sĩ ?</h5>
                <h5 class="font-weight-bold" style="padding-left: 20px !important;">{{ $ten_thanh_tu_si .' '. $ten_tu_si }}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" wire:click.prevent="delete()" class="btn btn-outline-danger d-inline-block px-3">Xóa</button>
            </div>
        </div>
    </div>
</div>