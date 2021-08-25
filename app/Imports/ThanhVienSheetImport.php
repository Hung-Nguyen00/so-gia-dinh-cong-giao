<?php

namespace App\Imports;

use App\Models\SoGiaDinh;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ThanhVienSheetImport implements ToCollection, WithHeadingRow
{
    private $sgdcg, $ten_thanh;

    public  function __construct()
    {
        $this->sgdcg = SoGiaDinh::all();
        $this->ten_thanh = TenThanh::all();
    }



    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $ma_so = $this->sgdcg->where('ma_so', trim($row['ma_so']))->first();
            $ten_thanh = $this->ten_thanh->where('ten_thanh', trim($row['ten_thanh']))->first();
            ThanhVien::create([
                'ho_va_ten' => trim($row['ho_va_ten']),
                'chuc_vu_gd' => $row['quan_he'],
                'ngay_sinh' =>  Carbon::parse($row['ngay_sinh'])->toDate(),
                'ngay_mat'  => Carbon::parse($row['ngay_mat'])->toDate(),
                'dia_chi_hien_tai' => $row['dia_chi_hien_tai'],
                'so_dien_thoai' => $row['so_dien_thoai'],
                'so_gia_dinh_id' => $ma_so->id,
                'ten_thanh_id' => $ten_thanh->id,
                'nguoi_khoi_tao' => Auth::id(),
            ]);
        }
    }
}
