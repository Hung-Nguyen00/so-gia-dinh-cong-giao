<?php

namespace Database\Factories;

use App\Models\GiaoHat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GiaoHatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GiaoHat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ten_giao_hat' => $this->faker->name(),
            'ngay_thanh_lap' => Carbon::now(),
            'giao_phan_id' => 1,
            'nguoi_khoi_tao' => 1
        ];
    }
}
