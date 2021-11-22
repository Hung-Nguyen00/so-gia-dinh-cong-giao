<div>
    @include('giao_ho.add_new')
    @include('giao_ho.edit')
    @include('giao_ho.delete')
    <div class="card-header">
        <h4 class="card-title">Danh sách các giáo họ </h4>
        <div>
            <button
                    data-toggle="modal" wire:click="clearData" data-target="#giaoHatModal"
                    class="btn btn-primary">Thêm giáo họ mới
            </button>
        </div>
    </div>
    <div class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 1080px;">
                <thead>
                <tr>
                    <th style="width: 10px" class="text-center">STT</th>
                    <th>Tên giáo họ</th>
                    <th style="width: 120px">Địa chỉ</th>
                    <th>Linh mục</th>
                    <th class="text-center">Năm thành lập</th>
                    <th>Số lượng người dân</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_giao_ho as $giao_ho)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $giao_ho->ten_giao_xu }}</td>
                        <td class="text-break">{{ $giao_ho->dia_chi }}</td>
                        <td>
                            @if($giao_ho->tuSi)
                                @foreach($giao_ho->tuSi as $g)
                                    @if($g->chucVu->ten_chuc_vu == 'Linh mục')
                                        {{ $g->tenThanh->ten_thanh . ' '. $g->ho_va_ten }}
                                        <br>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            @if(\Carbon\Carbon::parse($giao_ho->ngay_thanh_lap)->format('d-m') == '01-01' )
                                {{ \Carbon\Carbon::parse($giao_ho->ngay_thanh_lap)->format('Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($giao_ho->ngay_thanh_lap)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td class="text-center">{{ $giao_ho->giao_dan_count }}</td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $giao_ho->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoHat">
                                <i class="la la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $giao_ho->id }})"
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