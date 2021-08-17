<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GiaoHoImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            3 => new GiaoHoSheetImport(),
        ];
    }
}
