<div wire:ignore.self class="modal fade" id="uploadAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div wire:loading>
                <div id="loadingAddTVSgdcg" class="la-ball-circus la-2x" style="top: 30% !important;">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thay đổi ảnh đại diện</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form >
            <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                <img wire:ignore src="{{ asset('images/tusi.jpg') }}" id="output" style="width: 150px; height: 150px; border-radius: 50%" alt="">
                <input type="file" wire:model="avatar" onchange="loadFile(event)">
                @if($errors->has('avatar'))
                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                @endif
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" wire:click.prevent="changeAvatar"  data-dismiss="modal">Thay đổi</button>
                <button type="button" class="btn btn-outline-danger d-inline-block px-3" data-dismiss="modal">Hủy</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
            var loadFile = function(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
    </script>
@endpush