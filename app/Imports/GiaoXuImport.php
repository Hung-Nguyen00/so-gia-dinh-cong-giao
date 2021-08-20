<?php

namespace App\Imports;


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
