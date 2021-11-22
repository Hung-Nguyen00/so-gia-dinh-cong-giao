<div>
    <div wire:ignore.self class="modal fade" id="thanhVienModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm bên nam hoặc nữ</h5>
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
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="giao_xu">Tên giáo phận</label>
                            <select class="select form-control selectpicker" wire:model="giao_phan_id"
                                    data-live-search="true">
                                <option value="" selected>Chọn giáo phận</option>
                                @foreach($all_giao_phan as $th)
                                    <option value="{{ $th->id }}"> {{ $th->ten_giao_phan }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Giáo xứ</label>
                            <select class="select form-control selectpicker" wire:model="giao_xu_id"
                                    data-live-search="true">
                                @if(!$giao_phan_id)
                                    <option value="" selected>Không có dữ liệu</option>
                                @else
                                    <option value="" selected>Chọn giáo xứ</option>
                                @endif
                                @foreach($all_giao_xu as $th)
                                    <option value="{{ $th->id }}">GH: {{ $th->giaoHat->ten_giao_hat }}
                                        - {{ $th->ten_giao_xu }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex p-0">
                            <div class="col-md-6 p-0">
                                <label>Tên thánh</label>
                                <select class="select form-control selectpicker" wire:model="ten_thanh_id"
                                        data-live-search="true">
                                    <option value="" selected>Chọn tên thánh</option>
                                    @foreach($all_ten_thanh as $th)
                                        <option value="{{ $th->id }}"> {{ $th->ten_thanh }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 pr-0">
                                <label>Giới tính</label>
                                <select class="select form-control selectpicker" wire:model="chuc_vu_gd">
                                    <option value="" selected>Chọn giới tính</option>
                                    <option value="Cha">Nam</option>
                                    <option value="Mẹ">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" wire:model="ngay_sinh">
                        </div>
                        <div class="form-group">
                            <label>Tìm kiếm nam hoặc nữ</label>
                            <select class="select form-control selectpicker" wire:model="thanh_vien_id"
                                    data-live-search="true">
                                <option value="" selected>Chọn nam hoặc nữ</option>
                                @for($i = 0 ; $i < sizeof($thanh_vien) ; $i++)
                                    <option value="{{ $thanh_vien[$i]['id'] }}">
                                        {{  $thanh_vien[$i]['ten_thanh_vien']
                                         .' - Con ông: '. $thanh_vien[$i]['ten_thanh_cha'] .' '. $thanh_vien[$i]['ho_ten_cha']
                                         . ' Và bà: '.  $thanh_vien[$i]['ten_thanh_me'] .' '. $thanh_vien[$i]['ho_ten_me']
                                          }} </option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Lưu lại</button>
                        Hoặc
                        <a class="btn btn-primary"
                           href="{{ route('so-gia-dinh.createTV', ['sgdId' => $soGiaDinh->id] )}}">Tạo thành viên
                        </a>
                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Hủy
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>