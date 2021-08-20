<?php

namespace App\Imports;

use App\Models\ChucVu;
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
            ChucVu::create([
                'ten_chuc_vu' => $row['ten_chuc_vu'],
                'nguoi_khoi_tao'=> Auth::id(),
            ]);
        }

    }
}
