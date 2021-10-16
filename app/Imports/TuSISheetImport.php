<?php

namespace App\Imports;

use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\NhaDong;
use App\Models\TenThanh;
use App\Models\TuSi;
use App\Models\ViTri;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TuSISheetImport implements ToCollection, WithHeadingRow
{
    private $vi_tri, $chuc_vu, $giao_phan, $giao_hat, $giao_xu, $ten_thanh, $ten_dong;

    public function __construct()
    {
        $this->vi_tri = ViTri::select('id', 'ten_vi_tri')->get();
        $this->chuc_vu = ChucVu::select('id', 'ten_chuc_vu')->get();
        $this->giao_phan = GiaoPhan::select('id', 'ten_giao_phan')->get();
        $this->giao_hat = GiaoHat::select('id', 'ten_giao_hat')->get();
        $this->giao_xu = GiaoXu::select('id', 'ten_giao_xu')->get();
        $this->ten_thanh = TenThanh::select('id', 'ten_thanh')->get();
        $this->ten_dong = NhaDong::select('id', 'ten_nha_dong')->get();
    }


    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            if ($row['ho_va_ten'] == null){
                break;
            }
            $la_tong_giam_muc = '';
            $chuc_vu = $this->chuc_vu->where('ten_chuc_vu', trim($row['ten_chuc_vu']))->first();
            $vi_tri = $this->vi_tri->where('ten_vi_tri', trim($row['ten_vi_tri_phuc_vu']))->first();
            $giao_phan = $this->giao_phan->where('ten_giao_phan', trim($row['ten_giao_phan']))->first();
            $giao_hat = $this->giao_hat->where('ten_giao_hat', trim($row['ten_giao_hat']))->first();
            $giao_xu = $this->giao_xu->where('ten_giao_xu', trim($row['ten_giao_xu']))->first();
            $ten_thanh = $this->ten_thanh->where('ten_thanh', trim($row['ten_thanh']))->first();
            $ten_dong = $this->ten_dong->where('ten_nha_dong', trim($row['ten_dong_neu_co']))->first();

            if (trim($row['chuc_vi']) == 'Tổng giám mục')
            {
                $la_tong_giam_muc = 'T';
            }
            if (trim($row['chuc_vi']) == 'Giám mục phụ tá')
            {
                $la_tong_giam_muc = 'P';
            }
            if (trim($row['chuc_vi']) == 'Cha quản hạt')
            {
                $la_tong_giam_muc = 'Q';
            }
            TuSi::create([
                'ho_va_ten' => trim($row['ho_va_ten']),
                'email' => $row['email'],
                'la_tong_giam_muc' => $la_tong_giam_muc,
                'gioi_tinh' => $row['gioi_tinh'] == 'Nam' ? 1 : 0,
                'ngay_sinh' => $row['ngay_sinh'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh']) : null,
                'ngay_mat' => $row['ngay_mat'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_mat']) : null,
                'dia_chi_hien_tai' => $row['dia_chi_hien_tai'] ,
                'so_dien_thoai' => $row['so_dien_thoai'],
                'ngay_nhan_chuc' => $row['ngay_nhan_chuc'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_nhan_chuc']) : null,
                'noi_nhan_chuc' => $row['noi_nhan_chuc'],
                'dang_du_hoc' => $row['dang_du_hoc'],
                'nguoi_khoi_tao' => Auth::id(),
                'giao_phan_id' => $giao_phan ?  $giao_phan->id : null,
                'giao_hat_id' => $giao_hat ? $giao_hat->id : null,
                'giao_xu_id' => $giao_xu ? $giao_xu->id : null,
                'ten_thanh_id' => $ten_thanh->id,
                'chuc_vu_id' => $chuc_vu->id,
                'nha_dong_id' => $ten_dong ? $ten_dong->id : null,
                'bat_dau_phuc_vu' => $row['ngay_bat_dau_phuc_vu'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_bat_dau_phuc_vu']) : null,
                'vi_tri_id' =>  $vi_tri ? $vi_tri->id : null,
            ]);
        }

    }
}
