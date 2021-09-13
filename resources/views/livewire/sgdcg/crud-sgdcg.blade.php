<div>
    @include('sgdcg.add_giao_phan')
    @include('sgdcg.edit_giao_phan')
    @include('sgdcg.delete_giao_phan')
    @include('sgdcg.import');
    <div class="card-header">
        <h4 class="card-title">Danh sách các sổ gia đình công giáo </h4>
        <div>
            <a href="{{ route('sgdcg-file-export', ['name' => 'sgdcg'])}}"
                    class="btn btn-info">Excel mẫu
            </a>
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-info">Import dữ liệu
            </button>
            <button
                    data-toggle="modal" wire:click="clearData()" data-target="#createModal"
                    class="btn btn-primary">Thêm mới
            </button>
        </div>
    </div>
    <div  class="card-body">
        <div class="table-responsive">
            <table class="table display" style="min-width: 840px;">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sổ</th>
                    <th>Ngày tạo sổ</th>
                    <th class="text-center">Số lượng thành viên</th>
                    <th>Người khởi tạo</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_so_gia_dinh as $g)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $g->ma_so }}</td>
                        <td>{{ \Carbon\Carbon::parse($g->ngay_tao_so)->format('d-m-Y') }}</td>
                        <td class="text-center">{{ $g->thanh_vien_so2_count > 0 ? $g->thanh_vien_so2_count : $g->thanh_vien_count }}
                            <a href="{{ route('so-gia-dinh.show', $g)  }}"> <i class="la la-eye"></i></a>
                        <td>{{ $g->getUser->ho_va_ten }}</td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $g->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editModal">
                                <i class="la  fs-16 la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $g->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                    class="btn btn-outline-danger btn-sm d-inline-block mb-1">
                                <i class="la la-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $all_so_gia_dinh->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endpush