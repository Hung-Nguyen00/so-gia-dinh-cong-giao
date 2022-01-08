<?php

namespace Database\Seeders;

use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use App\Models\GiaoXu;
use App\Models\QuyenQuanTri;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use App\Models\TuSi;
use App\Models\User;
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
         $this->call(BiTichSeeder::class);
         $this->call(UserSeeder::class);
//        User::create([
//            'email' => 'test11@gmail.com',
//            'ho_va_ten' => 'Administrator',
//            'password' => bcrypt('password'),
//            'giao_phan_id' => 1,
//            'giao_xu_id' => 1,
//            'quyen_quan_tri_id' => 1,
//        ]);
//        User::create([
//            'email' => 'test12@gmail.com',
//            'ho_va_ten' => 'Administrator',
//            'password' => bcrypt('password'),
//            'giao_phan_id' => 1,
//            'giao_xu_id' => 1,
//            'quyen_quan_tri_id' => 1,
//        ]);
//        User::create([
//            'email' => 'test13@gmail.com',
//            'ho_va_ten' => 'Administrator',
//            'password' => bcrypt('password'),
//            'giao_phan_id' => 1,
//            'giao_xu_id' => 1,
//            'quyen_quan_tri_id' => 1,
//        ]);
//        User::create([
//            'email' => 'test14@gmail.com',
//            'ho_va_ten' => 'Administrator',
//            'password' => bcrypt('password'),
//            'giao_phan_id' => 1,
//            'giao_xu_id' => 1,
//            'quyen_quan_tri_id' => 1,
//        ]);
//
//        User::create([
//            'email' => 'testNgocThach@gmail.com',
//            'ho_va_ten' => 'Administrator',
//            'password' => bcrypt('password'),
//            'giao_phan_id' => 2,
//            'giao_xu_id' => 3,
//            'quyen_quan_tri_id' => 1,
//        ]);


//        #ThanhVien::truncate();
//        $tv = ThanhVien::factory(40000)->make();
//
//        $chunks = $tv->chunk(5000);
//        $chunks->each(function ($chunk){
//            ThanhVien::insert($chunk->toArray());
//        });
    }
}
