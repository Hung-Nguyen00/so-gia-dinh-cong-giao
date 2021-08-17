<?php

namespace App\Exports;

use App\Models\GiaoPhan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GiaoPhanExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return DB::table('giao_phan as gp')
                    ->join('giao_tinh as gt', 'gp.giao_tinh_id', '=', 'gt.id')
                    ->select('gp.ten_giao_phan', 'gp.dia_chi', 'gp.ngay_thanh_lap', 'gt.ten_giao_tinh')
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Tên giáo phận',
            'Địa chỉ',
            'Ngày thành lập',
            'Tên giáo tỉnh',
        ];
    }
}
