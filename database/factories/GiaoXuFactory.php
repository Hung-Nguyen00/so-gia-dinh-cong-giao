<?php

namespace Database\Factories;

use App\Models\GiaoXu;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GiaoXuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GiaoXu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ten_giao_xu' => $this->faker->name(),
            'dia_chi' => $this->faker->address(),
            'ngay_thanh_lap' => Carbon::now(),
            'giao_hat_id' => 1,
            'nguoi_khoi_tao' => 1
        ];
    }
}
