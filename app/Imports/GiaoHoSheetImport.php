<?php

namespace App\Imports;

use App\Models\GiaoXu;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GiaoHoSheetImport implements ToCollection, WithHeadingRow
{
    private $giao_xus;

    public function __construct()
    {
        $this->giao_xus = GiaoXu::select('id', 'ten_giao_xu', 'giao_hat_id')->get();
    }


    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $giao_xu = $this->giao_xus->where('ten_giao_xu', trim($row['ten_giao_xu']))->first();
            GiaoXu::create([
                'ten_giao_xu' => trim($row['ten_giao_ho']),
                'dia_chi'    => $row['dia_chi'],
                'ngay_thanh_lap' => Carbon::parse($row['ngay_thanh_lap'])->toDate(),
                'nguoi_khoi_tao'=> Auth::id(),
                'giao_xu_hoac_giao_ho' => $giao_xu->id,
                'giao_hat_id' => $giao_xu->giao_hat_id
            ]);
        }
    }
}
