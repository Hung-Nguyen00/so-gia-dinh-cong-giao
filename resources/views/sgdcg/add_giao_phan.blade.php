<div>
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="">Mã sổ</label>
                            <input type="text" wire:model="ma_so" disabled class="form-control bg-light"
                                   placeholder="Nhập mã sổ">
                        </div>
                        <div class="form-group">
                            <label for="">Giáo họ (nếu thuộc giáo họ)</label>
                            <select class="form-control select" wire:model.defer="is_giao_ho_id">
                                <option value="" selected>Chọn giáo họ</option>
                                @foreach($all_giao_ho as $h)
                                    <option value="{{ $h->id }}">{{ $h->ten_giao_xu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ">
                            <label>Ngày tạo sổ</label>
                            <input id="ngay_tao_so"
                                   type="date"
                                   wire:model.defer="ngay_tao_so"
                                   name="ngay_tao_so"
                                   value="{{ $ngay_tao_so }}"
                                   class="form-control col-md-5">
                            @if($errors->has('ngay_tao_so'))
                                <span class="text-danger">{{ $errors->first('ngay_tao_so') }}</span>
                            @endif
                        </div>
                        <div class="form-check col-md-6 d-flex align-items-start pt-2">
                            <input class="form-check-input" type="checkbox" wire:model.defer="la_nhap_xu">
                            <label class="form-check-label">
                                Sổ gia đình nhập xứ
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Thêm mới</button>
                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Hủy
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

