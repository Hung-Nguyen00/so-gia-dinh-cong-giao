<?php

namespace App\Imports;

use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GiaoPhanSheetImport implements WithHeadingRow, ToCollection
{
    /**
    * @param Collection $collection
    */
    private $giao_tinhs;

    public function __construct()
    {
        $this->giao_tinhs = GiaoTinh::select('id', 'ten_giao_tinh')->get();
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $giao_tinh = $this->giao_tinhs->where('ten_giao_tinh', trim($row['ten_giao_tinh']))->first();
            GiaoPhan::create([
                'ten_giao_phan' => trim($row['ten_giao_phan']),
                'ten_nha_tho' => $row['ten_nha_tho'],
                'dia_chi'    => $row['dia_chi'],
                'ngay_thanh_lap' =>$row['ngay_thanh_lap'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_thanh_lap']) : null,
                'nguoi_khoi_tao'=> Auth::id(),
                'giao_tinh_id' => $giao_tinh->id
            ]);
        }
    }
}
