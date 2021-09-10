<div>
    @include('nha_dong.add')
    @include('nha_dong.delete')
    @include('nha_dong.edit')
    @include('ten_thanh.import')
    <div class="card-header">
        <h4 class="card-title">Danh sách các nhà dòng</h4>
        <div>
            <a href="{{ route('sgdcg-file-export', ['name' => 'nha_dong'])}}"
               class="btn btn-info">Excel mẫu
            </a>
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-info">Import nhà dòng
            </button>
            <button
                    data-toggle="modal" data-target="#giaoHatModal"
                    class="btn btn-primary">Thêm mới
            </button>
        </div>
    </div>
    <div  class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px; width: 1180px">
                <thead>
                <tr>
                    <th style="width: 10px">STT</th>
                    <th style="width: 90px">Tên dòng</th>
                    <th style="width: 120px">Địa chỉ</th>
                    <th style="width: 80px">Năm thành lập</th>
                    <th style="width: 50px">Số lượng giáo họ</th>
                    <th style="width: 90px">Người cập nhập</th>
                    <th style="width: 50px">Cập nhập lần cuối</th>
                    <th style="width: 50px">Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_nha_dong as $nha_dong)
                    <tr >
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $nha_dong->ten_nha_dong }}</td>
                        <td>{{ $nha_dong->dia_chi }}</td>
                        <td class="text-center">
                            @if(\Carbon\Carbon::parse($nha_dong->ngay_thanh_lap)->format('d-m') == '01-01' )
                                {{ \Carbon\Carbon::parse($nha_dong->ngay_thanh_lap)->format('Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($nha_dong->ngay_thanh_lap)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td class="text-center">{{ $nha_dong->tu_si_count }}</td>
                        <td>{{ $nha_dong->getUser->ho_va_ten }}</td>
                        <td>{{ \Carbon\Carbon::parse($nha_dong->updated_at)->format('d-m-Y  H:i') }}</td>
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