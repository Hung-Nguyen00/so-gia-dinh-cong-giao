<?php

namespace Database\Seeders;

use App\Models\NhaDong;
use Illuminate\Database\Seeder;

class NhaDongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        NhaDong::create([
            'ten_nha_dong' => 'Cứu thế',
            'dia_chi' => 'Tp.HCM',
            'nguoi_khoi_tao' => 1,
        ]);
    }
}
