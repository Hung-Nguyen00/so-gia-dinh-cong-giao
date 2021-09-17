<div>
    @include('giao_hat.add_new')
    @include('giao_hat.edit')
    @include('giao_hat.delete')
    <div class="card-header">
        <h4 class="card-title">Danh sách các giáo hạt </h4>
        <div>
            <button
                    data-toggle="modal" wire:click="clearData()" data-target="#giaoHatModal"
                    class="btn btn-primary">Thêm giáo hạt mới
            </button>
        </div>
    </div>
    <div  class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px;">
                <thead>
                <tr>
                    <th style="width: 10px">STT</th>
                    <th style="width: 90px">Tên giáo hạt</th>
                    <th style="width: 60px">Năm thành lập</th>
                    <th style="width: 50px">Số lượng giáo xứ</th>
                    <th style="width: 90px">Người cập nhập</th>
                    <th style="width: 50px">Cập nhập lần cuối</th>
                    <th style="width: 50px">Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_giao_hat as $giao_hat)
                    <tr >
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $giao_hat->ten_giao_hat }}</td>
                        <td class="text-center">
                            @if(\Carbon\Carbon::parse($giao_hat->ngay_thanh_lap)->format('d-m') == '01-01' )
                                {{ \Carbon\Carbon::parse($giao_hat->ngay_thanh_lap)->format('Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($giao_hat->ngay_thanh_lap)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td class="text-center">{{ $giao_hat->giao_xu_count }}</td>
                        <td>{{ $giao_hat->getUser->ho_va_ten }}</td>
                        <td>{{ \Carbon\Carbon::parse($giao_hat->updated_at)->format('d-m-Y  H:i') }}</td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $giao_hat->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoHat">
                                <i class="la la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $giao_hat->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteGiaoHat"
                                    class="btn btn-outline-danger btn-sm d-inline-block mb-1">
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


@push('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endpush