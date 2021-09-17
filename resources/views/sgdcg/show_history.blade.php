<div>
    <div wire:ignore.self class="modal  fade" id="historySgdcg" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lịch sử chuyển xứ của sổ:  <strong class="text-primary">
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
                    <div  class="card-body">
                        <div class="table-responsive">
                            <table  class="table display" style="min-width: 500px">
                                <thead class="thead-primary">
                                <tr>
                                    <th class="text-center" style="width: 50px">STT</th>
                                    <th style="width: 150px">Tên giáo xứ</th>
                                    <th class="text-center" style="width: 150px">Ngày chuyển xứ</th>
                                    <th class="text-center" style="width: 250px;">Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody >
                                 @php $i = 0; @endphp
                                 @if($show_history_sgdcg)
                                    @foreach($show_history_sgdcg->lichSuChuyenXu as $s)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td>GP: {{ $s->giaoPhan->ten_giao_phan }}
                                            <br>
                                            GX: {{ $s->ten_giao_xu }}
                                        </td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($s->pivot->created_at)->format('d-m-Y') }}</td>
                                        <td class="text-break">{{ $s->pivot->note }}</td>
                                    </tr>
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