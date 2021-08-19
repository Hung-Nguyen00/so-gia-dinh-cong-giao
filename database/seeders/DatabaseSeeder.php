<?php

namespace Database\Seeders;

use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use App\Models\GiaoXu;
use App\Models\QuyenQuanTri;
use App\Models\TenThanh;
use App\Models\TuSi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        QuyenQuanTri::create(['ten_quyen' => 'admin']);
        GiaoTinh::factory(4)->create();
        GiaoPhan::factory(4)->create();
        GiaoHat::factory(4)->create();
        GiaoXu::factory(10)->create();
         \App\Models\User::factory(10)->create();
        TenThanh::factory(5)->create();
        ChucVu::factory(5)->create();
        TuSi::factory(50)->create();

    }
}
