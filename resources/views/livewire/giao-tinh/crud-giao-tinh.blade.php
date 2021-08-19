<div>
    @include('giao_phan.import_giao_phan')
    @include('giao_tinh.edit')
    <div class="card-header">
        <h4 class="card-title">Danh sách các giáo tỉnh </h4>
        <div>
            {{--<a class="btn btn-success" href="{{ route('GP-file-export') }}">Export data</a>--}}
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-primary">Import Excel
            </button>
        </div>
    </div>
    <div  class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px; width: 1100px !important;">
                <thead>
                <tr>
                    <th style="width: 20px">STT</th>
                    <th style="width: 90px">Tên giáo tỉnh</th>
                    <th style="width: 92px">Ngày thành lập</th>
                    <th style="width: 103px">Nhà thờ chính tòa</th>
                    <th style="width: 50px">Số lượng giáo phận</th>
                    <th style="width: 90px">Người cập nhập</th>
                    <th style="width: 50px">Cập nhập lần cuối</th>
                    <th style="width: 50px">Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_giao_tinh as $giao_tinh)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $giao_tinh->ten_giao_tinh }}</td>
                        <td>
                            @if(\Carbon\Carbon::parse($giao_tinh->ngay_thanh_lap)->format('d-m') == '01-01')
                                {{ \Carbon\Carbon::parse($giao_tinh->ngay_thanh_lap)->format('Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($giao_tinh->ngay_thanh_lap)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td>{{ $giao_tinh->ten_nha_tho }}</td>
                        <td class="text-center">{{ $giao_tinh->giao_phan_count }}</td>
                        <td>{{ $giao_tinh->user($giao_tinh->nguoi_khoi_tao) }}</td>
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