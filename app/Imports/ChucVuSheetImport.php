<?php

namespace App\Imports;

use App\Models\BiTich;
use App\Models\ChucVu;
use App\Models\NhaDong;
use App\Models\TenThanh;
use App\Models\ViTri;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ChucVuSheetImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection  $rows)
    {
        foreach ($rows as $row)
        {
            if (array_key_exists('ten_chuc_vu', $row->toArray()) && $row['ten_chuc_vu']){
                ChucVu::create([
                    'ten_chuc_vu' => trim($row['ten_chuc_vu']),
                    'nguoi_khoi_tao'=> Auth::id(),
                ]);
            }
            if (array_key_exists('ten_vi_tri', $row->toArray()) && $row['ten_vi_tri']){
                ViTri::create([
                    'ten_vi_tri' => trim($row['ten_vi_tri']),
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
            }
            if (array_key_exists('ten_thanh', $row->toArray()) && $row['ten_thanh']){
                TenThanh::create([
                    'ten_thanh' => trim($row['ten_thanh']),
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
            }

            if (array_key_exists('ten_dong', $row->toArray()) && $row['ten_dong']){
                NhaDong::create([
                    'ten_nha_dong' => trim($row['ten_dong']),
                    'dia_chi' => trim($row['dia_chi']),
                    'ngay_thanh_lap' => $row['ngay_thanh_lap'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_thanh_lap']) : null,
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
            }
        }

    }
}
