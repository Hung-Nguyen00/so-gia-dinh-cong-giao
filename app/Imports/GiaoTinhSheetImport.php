<?php

namespace App\Imports;

use App\Models\GiaoTinh;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GiaoTinhSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            if ($row['ten_giao_tinh']){
                GiaoTinh::create([
                    'ten_giao_tinh' => $row['ten_giao_tinh'],
                    'ten_nha_tho' => $row['nha_tho_chinh_toa'],
                    'dia_chi' => $row['dia_chi'],
                    'ngay_thanh_lap' => Carbon::parse($row['ngay_thanh_lap'])->toDate(),
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
            }
        }
    }
}