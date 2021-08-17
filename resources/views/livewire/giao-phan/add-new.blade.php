<div>
    @include('giao_phan.add_giao_phan')
    @include('giao_phan.edit_giao_phan')
    @include('giao_phan.delete_giao_phan')
    @include('giao_phan.import_giao_phan')
    <div class="card-header">
        <h4 class="card-title">Danh sách các giáo phận </h4>
        <div>
            <a class="btn btn-success" href="{{ route('GP-file-export') }}">Export data</a>
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-primary">Import Excel
            </button>
            <button
                    data-toggle="modal" data-target="#exampleModal"
                    class="btn btn-primary">Thêm giáo phận mới
            </button>
        </div>
    </div>
    <div  class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên giáo phận</th>
                    <th>Ngày thành lập</th>
                    <th>Sô lượng giáo hạt</th>
                    <th>Người dùng cập nhập</th>
                    <th>Cập nhập lần cuối</th>
                    <td>Chỉnh sửa</td>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_giao_phan as $giao_phan)
                    <tr >
                        <td> {{ ++$i }}</td>
                        <td>{{ $giao_phan->ten_giao_phan }}</td>
                        <td>{{ $giao_phan->ngay_thanh_lap }}</td>
                        <td>{{ $giao_phan->giao_hat_count }}</td>
                        <td>{{ $giao_phan->nguoi_khoi_tao }}</td>
                        <td>{{ $giao_phan->updated_at}}</td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $giao_phan->id }})"
                                    class="btn btn-sm btn-primary"
                                    data-toggle="modal"
                                    data-target="#editGiaoPhan">
                                <i class="la la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $giao_phan->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                    class="btn btn-sm btn-danger">
                                <i class="la la-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>