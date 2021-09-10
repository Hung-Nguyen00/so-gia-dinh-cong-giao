<?php

namespace Database\Seeders;

use App\Models\BiTich;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class BiTichSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BiTich::create([
            'ten_bi_tich' => 'Rửa tội',
            'nguoi_khoi_tao' => 1,
        ]);
        BiTich::create( [
            'ten_bi_tich' => 'Xưng tội',
            'nguoi_khoi_tao' => 1,
        ]);
        BiTich::create( [
            'ten_bi_tich' => 'Thêm sức',
            'nguoi_khoi_tao' => 1,
        ]);
        BiTich::create( [
            'ten_bi_tich' => 'Hôn phối',
            'la_hon_nhan' => 1,
            'nguoi_khoi_tao' => 1,
        ]);
    }
}
