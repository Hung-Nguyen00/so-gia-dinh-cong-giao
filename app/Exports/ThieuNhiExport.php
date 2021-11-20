<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ThieuNhiExport implements FromCollection, WithHeadings, WithMapping
{

    private $tv_id;

    public function __construct($tv_id)
    {
        $this->tv_id = $tv_id;
    }

    public function headings(): array{
        return [
            'Tên thánh',
            'Họ và tên',
            'Tên thánh của Cha',
            'Họ và tên của Cha',
            'Tên thánh của mẹ',
            'Họ và tên của mẹ',
            'Ngày sinh',
            'Số điện thoại',
            'Địa chỉ',
            'Giới tính',
        ];
    }



    public function map($row): array
    {
        return [

        ];
    }

    public function collection()
    {
        return '';
    }

}
