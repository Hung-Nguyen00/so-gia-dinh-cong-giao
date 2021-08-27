<div>
    @include('tu_si.delete_nhan_chuc')
    <table id="example3" class="table verticle-middle table-responsive-md mt-2">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Chức vụ</th>
            <th scope="col">Nơi nhận chức</th>
            <th scope="col">Ngày nhận chức</th>
            <th scope="col">Ngày cập nhập</th>
            <th scope="col">Xóa</th>
        </tr>
        </thead>
        <tbody>
        @if($lich_su_nhan_chuc->count() > 0)
            @php $i = 0; @endphp
            @foreach($lich_su_nhan_chuc as $ls)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $ls->chuc_vu }}</td>
                <td>{{ $ls->noi_nhan_chuc }}</td>
                <td>{{ \Carbon\Carbon::parse($ls->ngay_nhan_chuc)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($ls->ngay_cap_nhap)->format('d-m-Y') }}</td>
                <td>
                    <button data-toggle="modal"
                            data-target="#deleteNhanChuc"
                            wire:click="edit({{ $ls->id }})"
                            class="btn btn-outline-danger btn-sm d-inline-block"><i class="la la-trash-o"></i></button>
                </td>
            </tr>
            @endforeach
            @else
        @endif
        </tbody>
    </table>
</div>
