<?php

namespace Database\Factories;

use App\Models\TuSi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TuSiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TuSi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ho_va_ten' => $this->faker->name(),
            'ngay_sinh' => Carbon::now(),
            'dia_chi_hien_tai' => $this->faker->address(),
            'so_dien_thoai' => '01214936622',
            'ngay_nhan_chuc' => $this->faker->date(),
            'dang_du_hoc' => rand(0,1),
            'nguoi_khoi_tao' => 2,
            'chuc_vu_id' => 2,
            'giao_phan_id' => 2,
            'giao_xu_id' => 3,
            'ten_thanh_id' => 2,
        ];
    }
}
