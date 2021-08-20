<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GiaoPhanImport implements WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function sheets(): array
    {
        return [
            0 => new GiaoPhanSheetImport(),
//            1 => new GiaoHatSheetImport(),
//            2 => new GiaoXuSheetImport(),
//            3 => new GiaoHatSheetImport(),
        ];
    }
}
