<?php

namespace Database\Seeders;

use App\Models\GiaoHat;
use Illuminate\Database\Seeder;

class GiaoHatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GiaoHat::create([
            'ten_giao_hat' => 'Tây Nam',
            'ngay_thanh_lap' => '1990/01/01',
            'nguoi_khoi_tao' => 1,
            'giao_phan_id' => 1
        ]);
    }
}
