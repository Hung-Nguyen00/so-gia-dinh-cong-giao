<div>
    <div wire:ignore.self class="modal fade" id="historySgdcg" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lịch sử chuyển xứ của sổ: <strong class="text-primary">
                            @if($show_history_sgdcg)  {{ $show_history_sgdcg->ma_so }}
                            - Chủ hộ:
                            @if($show_history_sgdcg->thanhVien->count() > 0)
                                @foreach($show_history_sgdcg->thanhVien as $t)
                                    @if($t->tenThanh)
                                        {{ $t->tenThanh->ten_thanh . ' '. $t->ho_va_ten }}
                                    @else
                                        {{ $t->ho_va_ten }}
                                    @endif
                                    @break
                                @endforeach
                            @else
                                @if($show_history_sgdcg->thanhVienSo2)
                                    @foreach($show_history_sgdcg->thanhVienSo2 as $t)
                                        @if($t->tenThanh)
                                            {{ $t->tenThanh->ten_thanh . ' '. $t->ho_va_ten }}
                                        @else
                                            {{ $t->ho_va_ten }}
                                        @endif
                                        @break
                                    @endforeach
                                @endif
                            @endif
                            @endif
                        </strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div wire:loading>
                    <div id="loadingAddTVSgdcg" class="la-ball-circus la-2x" style="top: 35% !important;">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table display" style="min-width: 600px">
                                <thead class="thead-primary">
                                <tr>
                                    <th class="text-center" style="width: 50px">STT</th>
                                    <th style="width: 400px">Tên giáo xứ</th>
                                    <th class="text-center" style="width: 200px">Ngày chuyển xứ</th>
                                    <th class="text-center" style="width: 250px;">Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 0; $history_before = null; $t = 0 @endphp
                                @if($show_history_sgdcg)
                                    @foreach($show_history_sgdcg->lichSuChuyenXu as $s)
                                        @php ++$t; @endphp
                                        @if(sizeof($show_history_sgdcg->lichSuChuyenXu) == 1)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td>Từ: <strong>GP: {{ $s->giaoPhan->ten_giao_phan }} -
                                                        GX: {{ $s->ten_giao_xu }} </strong>
                                                    <br>
                                                    Đến: <strong>GP: {{ $giao_xu->giaoPhan->ten_giao_phan }} -
                                                        GX: {{ $giao_xu->ten_giao_xu }}</strong>
                                                </td>
                                                <td class="text-center">{{ \Carbon\Carbon::parse($s->pivot->created_at)->format('d-m-Y') }}

                                                </td>
                                                <td class="text-break">{{ $s->pivot->note }}</td>
                                            </tr>
                                        @endif
                                        @if($t == 1)
                                            @php  $history_before = $s @endphp
                                            @continue
                                        @endif

                                        @if($history_before !== null)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td>Từ: <strong>GP: {{ $history_before->giaoPhan->ten_giao_phan }} -
                                                        GX: {{ $history_before->ten_giao_xu }} </strong>
                                                    @if($history_before !== $s)
                                                        <br>
                                                        Đến:  <strong>GP: {{ $s->giaoPhan->ten_giao_phan }} -
                                                            GX: {{ $s->ten_giao_xu }}</strong>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ \Carbon\Carbon::parse($history_before->pivot->created_at)->format('d-m-Y') }}

                                                </td>
                                                <td class="text-break">{{ $history_before->pivot->note }}</td>
                                            </tr>
                                            @if($t == sizeof($show_history_sgdcg->lichSuChuyenXu))
                                                <tr>
                                                    <td class="text-center">{{ ++$i }}</td>
                                                    <td>Từ: <strong>GP: {{ $s->giaoPhan->ten_giao_phan }} -
                                                            GX: {{ $s->ten_giao_xu }} </strong>
                                                        <br>
                                                        Đến: <strong>GP: {{ $giao_xu->giaoPhan->ten_giao_phan }} -
                                                            GX: {{ $giao_xu->ten_giao_xu }}</strong>
                                                    </td>
                                                    <td class="text-center">{{ \Carbon\Carbon::parse($s->pivot->created_at)->format('d-m-Y') }}
                                                    </td>
                                                    <td class="text-break">{{ $s->pivot->note }}</td>
                                                </tr>
                                            @endif
                                            @php  $history_before = $s @endphp
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });

    </script>
@endsection