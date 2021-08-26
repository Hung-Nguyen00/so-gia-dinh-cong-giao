<?php

namespace App\Imports;

use App\Models\LichSuCongTac;
use App\Models\TuSi;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LichSuCongTacSheetImport implements ToCollection, WithHeadingRow
{
    private  $tu_si;

    public function __construct()
    {
        $this->tu_si = TuSi::select('id', 'ho_va_ten', 'so_dien_thoai')->get();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $tu_si = $this->tu_si->where('ho_va_ten', trim($row['ho_va_ten']))
                                    ->where('so_dien_thoai', trim($row['so_dien_thoai']))
                                    ->first();
            if ($tu_si){
                LichSuCongTac::create([
                    'ten_giao_phan' => $row['ten_giao_phan'],
                    'ten_giao_xu' => $row['ten_giao_phan'],
                    'ten_giao_hat' => $row['ten_giao_hat'],
                    'bat_dau_phuc_vu' => $row['thoi_gian_bat_dau'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['thoi_gian_bat_dau']) : null,
                    'ket_thuc_phuc_vu' =>$row['thoi_gian_ket_thuc'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['thoi_gian_ket_thuc']) : null,
                    'tu_si_id' => $tu_si->id,
                    'ten_vi_tri' => $row['vi_tri_phuc_vu']
                ]);
            }
        }
    }
}
