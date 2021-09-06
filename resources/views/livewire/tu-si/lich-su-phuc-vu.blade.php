<div>

    @include('tu_si.delete_phuc_vu')
    <div class="table-responsive">
        <table id="example3" class="table verticle-middle table-responsive-md mt-2">
        <thead>
        <tr>
            <th>STT</th>
            <th>Giáo phận</th>
            <th>Giáo hạt</th>
            <th>Giáo xứ</th>
            <th>Thời gian phục vụ</th>
            <th>Trạng thái</th>
            <th class="text-center" style="width: 105px">Xóa</th>
        </tr>
        </thead>
        <tbody>
         @php $i = 0; @endphp
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $tu_si->giaoPhan->ten_giao_phan }}</td>
                <td>@if($tu_si->giao_hat_id)
                        {{  $tu_si->giaoHat->ten_giao_hat}}
                    @endif
                </td>

                <td>@if($tu_si->giao_xu_id)
                        {{  $tu_si->giaoXu->ten_giao_xu}}
                    @endif</td>
                <td>{{ \Carbon\Carbon::parse($tu_si->bat_dau_phuc_vu)->format('d-m-Y')}}
                    @if($tu_si->ket_thuc_phuc_vu)
                        - {{\Carbon\Carbon::parse($tu_si->ket_thuc_phuc_vu)->format('d-m-Y')}}
                        @endif
                </td>
                <td><span class="badge badge-rounded badge-success">Đang phục vụ</span></td>
                <td class="text-center">
                </td>
            </tr>
            @foreach($lich_su_cong_tac as $ls)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $ls->ten_giao_phan }}</td>
                    <td>{{ $ls->ten_giao_hat }}</td>

                    <td>{{ $ls->ten_giao_xu }}</td>
                    <td>{{ \Carbon\Carbon::parse($ls->bat_dau_phuc_vu)->format('d-m-Y') .'-'. \Carbon\Carbon::parse($ls->ket_thuc_phuc_vu)->format('d-m-Y')}}</td>
                    <td><span class="badge badge-rounded badge-dark">Đã phục vụ</span></td>
                    <td class="text-center">
                        <button data-toggle="modal"
                                data-target="#deletePhucVu"
                                wire:click="edit({{ $ls->id }})"
                                class="btn btn-outline-danger btn-sm d-inline-block">
                            <i class="la la-trash-o"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
