<?php

namespace App\Imports;

use App\Models\LichSuNhanChuc;
use App\Models\TuSi;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LichSuNhanChucSheetImport implements ToCollection, WithHeadingRow
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
                LichSuNhanChuc::create([
                    'ngay_nhan_chuc' => Carbon::parse($row['ngay_nhan_chuc'])->toDate(),
                    'noi_nhan_chuc' => $row['noi_nhan_chuc'],
                    'ten_chuc_vu' => $row['ten_chuc_vu'],
                    'tu_si_id' =>  $tu_si->id,
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
            }
        }
    }
}
