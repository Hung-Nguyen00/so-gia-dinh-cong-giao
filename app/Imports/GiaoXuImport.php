<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GiaoXuImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            2 => new GiaoXuSheetImport(),
        ];
    }
}
