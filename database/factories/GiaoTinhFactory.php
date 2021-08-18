<?php

namespace Database\Factories;

use App\Models\GiaoTinh;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GiaoTinhFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GiaoTinh::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ten_giao_tinh' => $this->faker->name(),
            'ten_nha_tho' => $this->faker->name(),
            'dia_chi' => $this->faker->address(),
            'ngay_thanh_lap' => Carbon::now(),
            'nguoi_khoi_tao' => 1
        ];
    }
}
