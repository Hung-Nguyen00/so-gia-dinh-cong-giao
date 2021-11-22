<div>
    @include('nha_dong.add')
    @include('nha_dong.delete')
    @include('nha_dong.edit')
    @include('ten_thanh.import')
    <div class="card-header">
        <h4 class="card-title">Danh sách các nhà dòng</h4>
        <div>
            <a href="{{ route('sgdcg-file-export', ['name' => 'nha_dong'])}}"
               class="btn btn-info mt-1">Excel mẫu
            </a>
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-info mt-1">Import nhà dòng
            </button>
            <button
                    data-toggle="modal" wire:click="clearData" data-target="#giaoHatModal"
                    class="btn btn-primary mt-1">Thêm mới
            </button>
        </div>
    </div>
    <div class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 1080px;">
                <thead>
                <tr>
                    <th style="width: 10px">STT</th>
                    <th>Tên dòng</th>
                    <th>Địa chỉ</th>
                    <th>Năm thành lập</th>
                    <th>Số lượng tu sĩ</th>
                    <th>Người cập nhập</th>
                    <th>Cập nhập lần cuối</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_nha_dong as $nha_dong)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $nha_dong->ten_nha_dong }}</td>
                        <td>{{ $nha_dong->dia_chi }}</td>
                        <td class="text-center">
                            @if($nha_dong->ngay_thanh_lap)
                                @if(\Carbon\Carbon::parse($nha_dong->ngay_thanh_lap)->format('d-m') == '01-01' && strtotime($nha_dong->ngay_thanh_lap) < strtotime(2000) )
                                    {{ \Carbon\Carbon::parse($nha_dong->ngay_thanh_lap)->format('Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($nha_dong->ngay_thanh_lap)->format('d-m-Y') }}
                                @endif
                            @endif
                        </td>
                        <td class="text-center">{{ $nha_dong->tu_si_count }}</td>
                        <td>{{ $nha_dong->getUser->ho_va_ten }}</td>
                        <td>{{ \Carbon\Carbon::parse($nha_dong->updated_at)->format('d-m-Y H:i') }}</td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $nha_dong->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoHat">
                                <i class="la la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $nha_dong->id }})"
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