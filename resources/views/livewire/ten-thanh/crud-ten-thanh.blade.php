<div>
    @include('ten_thanh.add_new')
    @include('ten_thanh.edit')
    @include('ten_thanh.delete')
    <div class="card-header">
        <h4 class="card-title">Danh sách các tên thánh </h4>
        <div>
            <a class="btn btn-success" href="{{ route('GP-file-export') }}">Export data</a>
            <button
                    data-toggle="modal" data-target="#giaoHatModal"
                    class="btn btn-primary">Thêm giáo tên thánh
            </button>
        </div>
    </div>
    <div  class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px">
                <thead>
                <tr>
                    <th >STT</th>
                    <th>Tên tên thánh</th>
                    <th>Người cập nhập</th>
                    <th>Cập nhập lần cuối</th>
                    <th >Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_ten_thanh as $th)
                    <tr >
                        <td class="text-center"> {{ ++$i }}</td>
                        <td> {{ $th->ten_thanh }}</td>
                        <td>{{ $th->user($th->nguoi_khoi_tao) }}</td>
                        <td>{{ \Carbon\Carbon::parse($th->updated_at)->format('d-m-Y  H:i') }}</td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $th->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoHat">
                                <i class="la la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $th->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteGiaoHat"
                                    class="btn btn-sm btn-danger mb-1">
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