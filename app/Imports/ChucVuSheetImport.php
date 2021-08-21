<?php

namespace App\Imports;

use App\Models\ChucVu;
use App\Models\TenThanh;
use App\Models\ViTri;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ChucVuSheetImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection  $rows)
    {
        foreach ($rows as $row)
        {
            if ($row['ten_chuc_vu']){
                ChucVu::create([
                    'ten_chuc_vu' => $row['ten_chuc_vu'],
                    'nguoi_khoi_tao'=> Auth::id(),
                ]);
            }
            if ($row['ten_vi_tri']){
                ViTri::create([
                    'ten_vi_tri' => $row['ten_vi_tri'],
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
            }
            if ($row['ten_thanh']){
                TenThanh::create([
                    'ten_thanh' => $row['ten_thanh'],
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
            }
        }

    }
}
