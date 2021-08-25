<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LichSuCongTacImport implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */
    //

    public function sheets(): array
    {
        return [
            1 => new LichSuCongTacSheetImport(),
        ];
    }
}
