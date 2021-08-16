<?php

namespace Database\Seeders;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use App\Models\GiaoXu;
use App\Models\QuyenQuanTri;
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
        GiaoTinh::factory(2)->create();
        GiaoPhan::factory(2)->create();
        GiaoHat::factory(2)->create();
        GiaoXu::factory(2)->create();
         \App\Models\User::factory(10)->create();
    }
}
