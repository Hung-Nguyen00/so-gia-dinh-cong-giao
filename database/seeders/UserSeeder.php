<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'test@gmail.com',
            'ho_va_ten' => 'Administrator',
            'password' => bcrypt('password'),
            'giao_phan_id' => 1,
            'giao_xu_id' => 1,
            'quyen_quan_tri_id' => 1,
        ]);
        User::create([
            'email' => 'testGiaoPhan@gmail.com',
            'ho_va_ten' => 'Agency',
            'password' => bcrypt('password'),
            'giao_phan_id' => 1,
            'quyen_quan_tri_id' => 2
        ]);
        User::create([
            'email' => 'testGiaoXu@gmail.com',
            'ho_va_ten' => 'End',
            'password' => bcrypt('password'),
            'giao_phan_id' => 1,
            'giao_xu_id' => 1,
            'quyen_quan_tri_id' => 3
        ]);
    }
}
