<?php

namespace App\Imports;

use App\Models\BiTich;
use App\Models\BiTichDaNhan;
use App\Models\SoGiaDinh;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use App\Models\TuSi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportBiTichXTTSSheet implements ToCollection, WithHeadingRow
{
    private $tu_si, $bi_tich, $so_gia_dinh, $ten_thanh;

    public function __construct()
    {
        // prepare query before using in Foreach, because when run foreach it's don't need call these query.
        $this->tu_si = TuSi::select('id', 'ho_va_ten', 'ngay_sinh');
        $this->bi_tich = BiTich::all();
        $this->ten_thanh = TenThanh::all();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            if ($row['ho_va_ten'] == null && $row['ten_thanh'] == null){
                break;
            }
            $ten_thanh_linh_muc = $row['ten_thanh_giam_muc_hoac_linh_muc'];
            $ho_va_ten_cha= $row['ho_va_ten_cua_cha'];
            $ho_va_ten_me = $row['ho_va_ten_cua_me'];
            // get id TenThanh to check Cha and Me in SGDCG
            $ten_thanh_cha = $this->ten_thanh->where('ten_thanh', trim($row['ten_thanh_cua_cha']))->first();
            $ten_thanh_me = $this->ten_thanh->where('ten_thanh', trim($row['ten_thanh_cua_me']))->first();

            $format =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh_cua_giam_muc_hoac_linh_muc']);

            $tu_si = $this->tu_si->where('ho_va_ten', trim($row['ten_giam_muc_hoac_linh_muc']))
                ->where('ngay_sinh', $format->format('Y-m-d'))
                ->whereHas('tenThanh', function ($q) use($ten_thanh_linh_muc){
                    $q->where('ten_thanh', trim($ten_thanh_linh_muc));
                })
                ->first();


            $so_gia_dinh = SoGiaDinh::with('thanhVien')
                ->whereHas('thanhVien',
                    function ($q) use($ho_va_ten_cha, $ten_thanh_cha) {
                        $q->where('ho_va_ten', trim($ho_va_ten_cha))
                          ->where('ten_thanh_id', $ten_thanh_cha->id);
                })
               ->whereHas('thanhVien',
                   function ($q) use($ho_va_ten_me, $ten_thanh_me) {
                       $q->where('ho_va_ten', trim($ho_va_ten_me))
                        ->where('ten_thanh_id', $ten_thanh_me->id);
                   })
               ->first();

            $ten_thanh = $this->ten_thanh->where('ten_thanh', trim($row['ten_thanh']))->first();
            $bi_tich = $this->bi_tich->where('ten_bi_tich', trim($row['ten_bi_tich']))->first();
            $thanh_vien = ThanhVien::with('biTich')->where('so_gia_dinh_id', $so_gia_dinh->id)
                            ->where('ten_thanh_id', $ten_thanh->id)
                            ->where('ho_va_ten', trim($row['ho_va_ten']))
                            ->first();
            // take first line and break row
            BiTichDaNhan::create([
                'bi_tich_id' => $bi_tich->id,
                'thanh_vien_id' => $thanh_vien->id,
                'ngay_dien_ra' => $row['ngay_dien_ra'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_dien_ra']) : null,
                'noi_dien_ra' => $row['noi_dien_ra'],
                'ten_nguoi_do_dau' => $row['ten_nguoi_do_dau'],
                'ten_thanh_nguoi_do_dau'=> $row['ten_thanh_nguoi_do_dau'],
                'ngay_sinh_nguoi_do_dau' => $row['ngay_sinh_nguoi_do_dau'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh_nguoi_do_dau']) : null,
                'nguoi_khoi_tao' => Auth::id(),
                'tu_si_id' => $tu_si->id,
                ]);
            }
        }
}
