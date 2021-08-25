<?php

namespace Database\Seeders;

use App\Models\GiaoPhan;
use Illuminate\Database\Seeder;

class GiaoPhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GiaoPhan::create([
            'ten_giao_phan' => 'Bắc Ninh',
            'dia_chi' => 'Hà Nội',
            'ten_nha_tho' => 'Nhà thờ Lớn Hà Nội',
            'ngay_thanh_lap' => '1990/01/01',
            'nguoi_khoi_tao' => 1,
            'giao_tinh_id' => 1
        ]);
    }
}
