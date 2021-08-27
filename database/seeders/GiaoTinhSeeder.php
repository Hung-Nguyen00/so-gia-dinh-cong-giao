<?php

namespace Database\Seeders;

use App\Models\GiaoTinh;
use Illuminate\Database\Seeder;

class GiaoTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        GiaoTinh::create([
            'ten_giao_tinh' => 'Hà Nội',
            'dia_chi' => 'Hà Nội',
            'ten_nha_tho' => 'Nhà thờ Lớn Hà Nội',
            'ngay_thanh_lap' => '1990/01/01',
            'nguoi_khoi_tao' => 1
        ]);
    }
}
