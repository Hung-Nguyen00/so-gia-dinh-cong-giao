<div>
    @include('giao_phan.add_giao_phan')
    @include('giao_phan.edit_giao_phan')
    @include('giao_phan.import_giao_phan')
    @include('giao_phan.delete_giao_phan')

    <div class="card-header">
        <h4 class="card-title">Danh sách các giáo phận </h4>
        <div>
            <a href="{{ route('sgdcg-file-export', ['name' => 'giao_phan'])}}"
               class="btn btn-info">Excel mẫu
            </a>
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-primary">Import giáo phận, giáo hạt, giáo xứ
            </button>
            <button
                    data-toggle="modal" wire:click="clearData()" data-target="#exampleModal"
                    class="btn btn-primary">Thêm giáo phận mới
            </button>
        </div>
    </div>
    <div class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px; width: 1100px !important;">
                <thead>
                <tr>
                    <th style="width: 20px">STT</th>
                    <th style="width: 90px">Tên giáo phận</th>
                    <th style="width: 92px">Ngày thành lập</th>
                    <th style="width: 103px">Nhà thờ chính tòa</th>
                    <th style="width: 50px">Số lượng giáo hạt</th>
                    <th style="width: 90px">Người cập nhập</th>
                    <th style="width: 60px">Cập nhập lần cuối</th>
                    <th style="width: 50px">Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_giao_phan as $giao_phan)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $giao_phan->ten_giao_phan }}</td>
                        <td>
                            @if(\Carbon\Carbon::parse($giao_phan->ngay_thanh_lap)->format('d-m') == '01-01')
                                {{ \Carbon\Carbon::parse($giao_phan->ngay_thanh_lap)->format('Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($giao_phan->ngay_thanh_lap)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td>{{ $giao_phan->ten_nha_tho }}</td>
                        <td class="text-center">{{ $giao_phan->giao_hat_count }}</td>
                        <td>{{ $giao_phan->getUser->ho_va_ten }}</td>
                        <td>{{\Carbon\Carbon::parse($giao_phan->updated_at)->format('d-m-Y  H:i') }}</td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $giao_phan->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoPhan">
                                <i class="la la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $giao_phan->id }})"
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