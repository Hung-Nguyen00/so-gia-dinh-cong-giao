<?php

namespace App\Imports;

use App\Models\ViTri;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ViTriSheetImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection  $rows)
    {
        foreach ($rows as $row)
        {
            $vitri = ViTri::create([
                'ten_vi_tri' => $row['ten_vi_tri'],
                'nguoi_khoi_tao'=> Auth::id(),
            ]);
        }

    }
}
