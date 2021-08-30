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
        QuyenQuanTri::create(['ten_quyen' => 'Giáo phận']);
        QuyenQuanTri::create(['ten_quyen' => 'Giáo xứ']);
        $this->call(GiaoTinhSeeder::class);
        $this->call(GiaoPhanSeeder::class);
        $this->call(GiaoHatSeeder::class);
        $this->call(NhaDongSeeder::class);
        $this->call(GiaoXuSeeder::class);
         $this->call(UserSeeder::class);
    }
}
