<div>
    @include('giao_ho.add_new')
    @include('giao_ho.edit')
    @include('giao_ho.delete')
    <div class="card-header">
        <h4 class="card-title">Danh sách các giáo họ </h4>
        <div>
            {{--<a class="btn btn-success" href="{{ route('GP-file-export') }}">Export data</a>--}}
            <button
                    data-toggle="modal" data-target="#giaoHatModal"
                    class="btn btn-primary">Thêm giáo họ mới
            </button>
        </div>
    </div>
    <div  class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px; width: 1180px">
                <thead>
                <tr>
                    <th style="width: 10px">STT</th>
                    <th style="width: 90px">Tên giáo họ</th>
                    <th style="width: 120px">Địa chỉ</th>
                    <th style="width: 80px">Năm thành lập</th>
                    <th style="width: 50px">Số lượng người dân</th>
                    <th style="width: 90px">Người cập nhập</th>
                    <th style="width: 50px">Cập nhập lần cuối</th>
                    <th style="width: 50px">Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_giao_ho as $giao_ho)
                    <tr >
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $giao_ho->ten_giao_xu }}</td>
                        <td>{{ $giao_ho->dia_chi }}</td>
                        <td class="text-center">
                            @if(\Carbon\Carbon::parse($giao_ho->ngay_thanh_lap)->format('d-m') == '01-01' )
                                {{ \Carbon\Carbon::parse($giao_ho->ngay_thanh_lap)->format('Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($giao_ho->ngay_thanh_lap)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td>0</td>
                        <td>{{ $giao_ho->user($giao_ho->nguoi_khoi_tao) }}</td>
                        <td>{{ \Carbon\Carbon::parse($giao_ho->updated_at)->format('d-m-Y  H:i') }}</td>
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