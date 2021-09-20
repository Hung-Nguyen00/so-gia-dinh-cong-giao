<div>
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin chuyển xứ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div wire:loading>
                    <div id="loadingAddTVSgdcg" class="la-ball-circus la-2x">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="giao_phan">Mã sổ</label>
                            <input type="text" wire:model="ma_so" disabled class="select bg-light form-control" placeholder="Nhập mã sổ">
                            @if($errors->has('ma_so'))
                                <span class="text-danger">{{ $errors->first('ma_so') }}</span>
                            @endif
                        </div>
                        <div class="form-group" >
                            <label for="giao_phan">Tên giáo phận</label>
                            <select data-live-search="true" {{ $giao_xu_id_old !== \Auth::user()->giao_xu_id ? 'disabled' : '' }} class="select form-control bg-light" name="giao_phan_id" wire:change="changeGiaoHat" wire:model="giao_phan_id">
                                <option selected>Chọn giáo phận</option>
                                @foreach($all_giao_phan as $gt)
                                    <option value="{{ $gt->id }}"> {{ $gt->ten_giao_phan  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="giao_phan">Tên giáo hạt</label>
                            <select data-live-search="true"   {{ $giao_xu_id_old !== \Auth::user()->giao_xu_id ? 'disabled' : '' }} class="select form-control bg-light" name="giao_hat_id"  wire:model="giao_hat_id">
                                @if($giao_hat_id == null)
                                <option selected value="">Chọn giáo hạt</option>
                                @endif
                                @if($all_giao_hat->count() > 0)
                                    @foreach($all_giao_hat as $gt)
                                        <option value="{{ $gt->id }}"> {{ $gt->ten_giao_hat  }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group" >
                            <label for="giao_phan">Tên giáo xứ</label>
                            <select data-live-search="true"  {{ $giao_xu_id_old !== \Auth::user()->giao_xu_id ? 'disabled' : '' }}
                            class="form-control select " name="giao_xu_id" wire:model="giao_xu_id">
                                @if($giao_xu_id == null)
                                    <option selected value="">Chọn giáo xứ</option>
                                @endif
                                @foreach($all_giao_xu as $gt)
                                    <option value="{{ $gt->id }}"> {{ $gt->ten_giao_xu  }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('giao_xu_id'))
                                <span class="text-danger">{{ $errors->first('giao_xu_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between">
                            <div class="col-md-5 mt-1 p-0">
                                <label class="pl-1">Ngày chuyển xứ</label>
                                <input type="date" wire:model="ngay_chuyen_xu" class="form-control">
                                @if($errors->has('ngay_chuyen_xu'))
                                    <span class="text-danger">{{ $errors->first('ngay_chuyen_xu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Chú thích</label>
                            <textarea wire:model.lazy="note" class="form-control" rows="3"> {{ $note }}</textarea>
                            @if($errors->has('note'))
                                <span class="text-danger">{{ $errors->first('note') }}</span>
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

@section('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endsection