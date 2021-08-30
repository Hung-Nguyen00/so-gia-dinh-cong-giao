<?php

namespace Database\Seeders;

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
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'ho_va_ten' => 'Administrator',
                'email' => 'test@gmail.com',
                'password' => bcrypt('password'),
                'giao_phan_id' => 1,
                'quyen_quan_tri_id' => 1,
            ],
            [
                'ho_va_ten' => 'Agency',
                'email' => 'testGiaoPhan@gmail.com',
                'password' => bcrypt('password'),
                'giao_phan_id' => 1,
                'quyen_quan_tri_id' => 2
            ],
            [
                'ho_va_ten' => 'End',
                'email' => 'testGiaoXu@gmail.com',
                'password' => bcrypt('password'),
                'giao_phan_id' => 1,
                'giao_xu_id' => 1,
                'quyen_quan_tri_id' => 3
            ]
        ]);
    }
}
