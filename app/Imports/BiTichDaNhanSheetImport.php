<?php

namespace App\Imports;

use App\Models\BiTich;
use App\Models\BiTichDaNhan;
use App\Models\ThanhVien;
use App\Models\TuSi;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BiTichDaNhanSheetImport implements ToCollection, WithHeadingRow
{
    private $tu_si, $bi_tich, $thanh_vien;

    public function __construct()
    {
        $this->tu_si = TuSi::select('id', 'ho_va_ten', 'ngay_sinh')->get();
        $this->thanh_vien = DB::table('thanh_vien as t')
                            ->join('so_gia_dinh_cong_giao as s', 't.so_gia_dinh_id', '=', 's.id')
                            ->select('t.id as tvId', 's.ma_so', 't.ho_va_ten as ho_va_ten')
                            ->get();
        $this->bi_tich = BiTich::all();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $format =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh_cua_giam_muc_hoac_linh_muc']);
            $tu_si_id = $this->tu_si->where('ho_va_ten', trim($row['ten_giam_muc_hoac_linh_muc']))
                                    ->where('ngay_sinh', $format->format('Y-m-d'))
                                    ->first();
            $thanh_vien = $this->thanh_vien->where('ma_so', trim($row['ma_so']))
                                            ->where('ho_va_ten', trim($row['ho_va_ten']))
                                            ->first();
            $bi_tich = $this->bi_tich->where('ten_bi_tich', trim($row['ten_bi_tich']))->first();
            BiTichDaNhan::create([
                'bi_tich_id' => $bi_tich->id,
                'thanh_vien_id' => $thanh_vien->tvId,
                'ngay_dien_ra' => $row['ngay_dien_ra'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_dien_ra']) : null,
                'noi_dien_ra' => $row['noi_dien_ra'],
                'ten_nguoi_do_dau' => $row['ten_nguoi_do_dau'],
                'ten_thanh_nguoi_do_dau'=> $row['ten_thanh_nguoi_do_dau'],
                'ngay_sinh_nguoi_do_dau' => $row['ngay_sinh_nguoi_do_dau'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh_nguoi_do_dau']) : null,
                'ten_nguoi_lam_chung_1'=> $row['ten_nguoi_lam_chung_1'],
                'ten_thanh_nguoi_lam_chung_1'=> $row['ten_thanh_nguoi_lam_chung_1'],
                'ngay_sinh_nguoi_lam_chung_1' => $row['ngay_sinh_nguoi_lam_chung_1'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh_nguoi_lam_chung_1']) : null,
                'ten_nguoi_lam_chung_2'=> $row['ten_nguoi_lam_chung_2'],
                'ten_thanh_nguoi_lam_chung_2'=> $row['ten_thanh_nguoi_lam_chung_2'],
                'ngay_sinh_nguoi_lam_chung_2' =>$row['ngay_sinh_nguoi_lam_chung_2'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh_nguoi_lam_chung_2']) : null,
                'nguoi_khoi_tao' => Auth::id(),
                'tu_si_id' => $tu_si_id->id,
            ]);
        }
    }
}
