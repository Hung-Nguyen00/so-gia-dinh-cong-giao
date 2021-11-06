<?php

namespace Database\Factories;

use App\Models\ThanhVien;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThanhVienFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThanhVien::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'ho_va_ten' => $this->faker->name(),
            'ngay_sinh' => Carbon::now()->format('d-m-y'),
            'dia_chi_hien_tai' => $this->faker->address(),
            'ten_thanh_id' => 1,
            'gioi_tinh' => 1,
            'so_gia_dinh_id' => 1,
            'nguoi_khoi_tao' => 1
        ];
    }
}
