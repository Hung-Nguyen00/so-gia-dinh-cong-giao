<?php

namespace App\Imports;

use App\Models\BiTich;
use App\Models\BiTichDaNhan;
use App\Models\GiaoXu;
use App\Models\SoGiaDinh;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use App\Models\TuSi;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BiTichDaNhanSheetImport implements ToCollection, WithHeadingRow
{
    private $tu_si, $bi_tich, $thanh_vien, $so_gia_dinh, $check_exist_tv, $ten_thanh, $check_hvt, $flag;

    public function __construct()
    {
        $this->tu_si = TuSi::select('id', 'ho_va_ten', 'ngay_sinh')->get();
        $this->bi_tich = BiTich::all();
        $this->ten_thanh = TenThanh::all();
        $this->so_gia_dinh = null;
        $this->thanh_vien = null;
        $this->check_exist_tv = false;
        $this->check_hvt = null;
        $this->flag = false;
    }



    public function collection(Collection $rows)
    {
        $count = 0;
        foreach ($rows as $row){
            $format =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh_cua_giam_muc_hoac_linh_muc']);
            $tu_si_id = $this->tu_si->where('ho_va_ten', trim($row['ten_giam_muc_hoac_linh_muc']))
                                    ->where('ngay_sinh', $format->format('Y-m-d'))
                                    ->first();
            $ten_thanh = $this->ten_thanh->where('ten_thanh', trim($row['ten_thanh']))->first();
            $bi_tich = $this->bi_tich->where('ten_bi_tich', trim($row['ten_bi_tich']))->first();
            // take first line and break row
            if ($row['ho_va_ten'] == null){
                $this->flag = true;
                continue;
            }
            if ($count == 0 || $this->flag){
                // get id GX by User
                $get_giao_xu = GiaoXu::with(['giaoPhan', 'giaoHat'])->where('id', Auth::user()->giao_xu_id)->first();
                $last_sgdcg = SoGiaDinh::all()->last();
                $name_GP = $this->getUpperCase($get_giao_xu->giaoPhan->ten_giao_phan);
                $name_GH = $this->getUpperCase($get_giao_xu->giaoHat->ten_giao_hat);
                $name_GX = $this->getUpperCase($get_giao_xu->ten_giao_xu);

                if ($last_sgdcg){
                    $ma_so = $name_GP. '-'.$name_GH. '-'. $name_GX .'-'. ($last_sgdcg->id + 1);
                }else{
                    $ma_so = $name_GP. '-'.$name_GH. '-'. $name_GX .'-'. 0;
                }
                // create so_gia_dinh
                $this->so_gia_dinh = SoGiaDinh::create([
                    'ma_so' => $ma_so,
                    'ngay_tao_so' => $row['ngay_lap_so'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_lap_so']) : null,
                    'nguoi_khoi_tao' => Auth::id(),
                    'giao_xu_id' => Auth::user()->giao_xu_id,
                ]);
                $count ++;
                $this->flag = false;
            }
            // check duplicate row
            if ($row['ho_va_ten'] == $this->check_hvt){
                $this->check_exist_tv = true;
            }else{
                $this->check_exist_tv = false;
                $this->check_hvt = $row['ho_va_ten'];
            }
            if ($this->so_gia_dinh && !$this->check_exist_tv){
                $this->thanh_vien  = ThanhVien::create([
                    'ho_va_ten' => trim($row['ho_va_ten']),
                    'chuc_vu_gd' => $row['quan_he'],
                    'gioi_tinh' => $row['gioi_tinh'] == 'Nam' ? 1 : 0,
                    'ngay_sinh' =>  $row['ngay_sinh'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh']) : null,
                    'ngay_mat'  => $row['ngay_mat'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_mat']) : null,
                    'dia_chi_hien_tai' => $row['dia_chi_hien_tai'],
                    'so_dien_thoai' => $row['so_dien_thoai'],
                    'so_gia_dinh_id' => $this->so_gia_dinh->id,
                    'ten_thanh_id' => $ten_thanh->id,
                    'nguoi_khoi_tao' => Auth::id(),
                ]);
                BiTichDaNhan::create([
                    'bi_tich_id' => $bi_tich->id,
                    'thanh_vien_id' =>$this->thanh_vien->id,
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
            if ($this->check_exist_tv){
                BiTichDaNhan::create([
                    'bi_tich_id' => $bi_tich->id,
                    'thanh_vien_id' =>$this->thanh_vien->id,
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
}
