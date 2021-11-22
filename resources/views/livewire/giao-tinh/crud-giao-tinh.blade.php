<div>

    @include('giao_tinh.edit')
    <div class="card-header">
        <h4 class="card-title">Danh sách các giáo tỉnh </h4>
    </div>
    <div class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px;">
                <thead>
                <tr>
                    <th style="width: 20px">STT</th>
                    <th>Tên giáo tỉnh</th>
                    <th>Số lượng giáo phận</th>
                    <th>Người cập nhập</th>
                    <th>Cập nhập lần cuối</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_giao_tinh as $giao_tinh)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $giao_tinh->ten_giao_tinh }}</td>
                        <td class="text-center">{{ $giao_tinh->giao_phan_count }}</td>
                        <td>{{ $giao_tinh->getUser->ho_va_ten }}</td>
                        <td>{{\Carbon\Carbon::parse($giao_tinh->updated_at)->format('d-m-Y  H:i') }}</td>
                        <td class="text-center">
                            <button type="button"
                                    wire:click="edit({{ $giao_tinh->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoPhan">
                                <i class="la la-pencil"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>