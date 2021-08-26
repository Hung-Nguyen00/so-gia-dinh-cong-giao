<?php

namespace App\Imports;

use App\Models\SoGiaDinh;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoGiaDinhSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            SoGiaDinh::create([
               'ma_so' => trim($row['ma_so']),
               'ngay_tao_so' => $row['ngay_lap_so'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_lap_so']) : null,
                'nguoi_khoi_tao' => Auth::id(),
                'giao_xu_id' => Auth::user()->giao_xu_id,
            ]);
        }
    }
}
