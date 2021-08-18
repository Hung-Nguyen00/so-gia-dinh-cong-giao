<?php

namespace Database\Factories;

use App\Models\GiaoPhan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GiaoPhanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GiaoPhan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ten_giao_phan' => $this->faker->name(),
            'ten_nha_tho' => $this->faker->name(),
            'dia_chi' => $this->faker->address(),
            'ngay_thanh_lap' => Carbon::now(),
            'giao_tinh_id' => 1,
            'nguoi_khoi_tao' => 1
        ];
    }
}
