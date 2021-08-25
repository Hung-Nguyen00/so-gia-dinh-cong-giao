<?php

namespace Database\Seeders;

use App\Models\GiaoXu;
use Illuminate\Database\Seeder;

class GiaoXuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GiaoXu::create([
            'ten_giao_xu' => 'Thạnh An',
            'dia_chi' => 'Hà Nội',
            'ngay_thanh_lap' => '1990/01/01',
            'nguoi_khoi_tao' => 1,
            'giao_hat_id' => 1
        ]);
    }
}
