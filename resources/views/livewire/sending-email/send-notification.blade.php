<div>
    <div class="card-header d-flex flex-wrap">
        <div class="col-md-3 mt-3">
            <label>Tìm kiếm email</label>
            <select data-live-search="true" class="selectpicker w-auto select form-control" wire:model="email_id">
                @foreach($all_emails as $t)
                    @if($t->id == $email_id)
                        <option value="{{ $t->id }}" selected>{{ $t->title }}</option>
                    @else
                        <option value="{{ $t->id }}">{{ $t->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-2 mt-3">
            <div class="align-items-end mt-3">
                <label>Hiển thị</label>
                <select class="form-control select w-auto" wire:model="paginate_number">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20" selected>20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>
    <div wire:loading>
        <div id="loadingAddTVSgdcg" class="la-ball-circus la-2x" style="top: 50% !important;">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="card-body">
        <form role="form" class="col-md-12 col-lg-12">
            <div class="col-md-6 col-lg-6 p-0 pr-2 float-left pb-3">
                <div class="controls">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form_email">Tiêu đề</label>
                                <input id="form_email" name="title" class="form-control"
                                       value="{{ $title }}"
                                       placeholder="Nhập tiêu đề">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form_message">Nội dung</label>
                                <textarea id="form_message" name="content"
                                          class="form-control"
                                          placeholder="Nhập nội dung" rows="6"
                                >{{ $content }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive col-md-6 border pb-3 col-lg-6 pt-3">
                <table class="table" >
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Giáo Hạt</th>
                        <th>Tên Giáo Xứ</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($gxs)
                        @php $i = 0; @endphp
                        @foreach($gxs as $gx)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $gx->giaoHat->ten_giao_hat }}</td>
                                <td>{{ $gx->ten_giao_xu }}</td>
                                <td>
                                    <span class="badge badge-rounded badge-success">Đã gửi</span>
                                </td>
                            </tr>
                        @endforeach
                        @foreach($gx_pending as $g)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $g->giaoHat->ten_giao_hat }}</td>
                                <td>{{ $g->ten_giao_xu }}</td>
                                <td>
                                    <span class="badge badge-rounded badge-warning">Đang gửi</span>
                                </td>
                            </tr>
                        @endforeach
                        @foreach($gx_error as $e)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $e->giaoHat->ten_giao_hat }}</td>
                                <td>{{ $e->ten_giao_xu }}</td>
                                <td>
                                    <span class="badge badge-rounded badge-success">Không thành công</span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });

    </script>
@endpush