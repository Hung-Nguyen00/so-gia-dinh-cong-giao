<div>
    @include('vi_tri.add_new')
    @include('vi_tri.edit')
    @include('vi_tri.delete')
    @include('ten_thanh.import')
    <div class="card-header">
        <h4 class="card-title">Danh sách vị trí phục vụ giáo xứ </h4>
        <div>
            <a href="{{ route('sgdcg-file-export', ['name' => 'ten_thanh'])}}"
               class="btn btn-info mt-1">Excel mẫu
            </a>
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-info mt-1">Nhập Excel
            </button>
            <button
                    data-toggle="modal" wire:click="clearData" data-target="#giaoHatModal"
                    class="btn btn-primary mt-1">Thêm mới vị trí
            </button>
        </div>
    </div>
    <div class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px">
                <thead>
                <tr>
                    <th style="width: 20px">STT</th>
                    <th>Tên vị trí</th>
                    <th class="text-center">Số lượng tu sĩ</th>
                    <th>Người cập nhập</th>
                    <th>Cập nhập lần cuối</th>
                    <th class="text-center">Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_vi_tri as $th)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td> {{ $th->ten_vi_tri }}</td>
                        <td class="text-center"> {{ $th->tu_si_count }}</td>
                        <td>{{ $th->getUser->ho_va_ten }}</td>
                        <td>{{ \Carbon\Carbon::parse($th->updated_at)->format('d-m-Y  H:i') }}</td>
                        <td class="text-center">
                            <button type="button"
                                    wire:click="edit({{ $th->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoHat">
                                <i class="la la-pencil"></i>
                            </button>
                            @if($th->tu_si_count == 0)
                            <button type="button" wire:click="edit({{ $th->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteGiaoHat"
                                    class="btn btn-outline-danger btn-sm d-inline-block mb-1">
                                <i class="la la-trash-o"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>