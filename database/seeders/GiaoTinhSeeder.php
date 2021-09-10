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
            'nguoi_khoi_tao' => 1
        ]
        );
        GiaoTinh::create(
            [
                'ten_giao_tinh' => 'Huế',
                'nguoi_khoi_tao' => 1
            ]);
        GiaoTinh::create(
        [
            'ten_giao_tinh' => 'Sài Gòn',
            'nguoi_khoi_tao' => 1
        ]
        );

    }
}
