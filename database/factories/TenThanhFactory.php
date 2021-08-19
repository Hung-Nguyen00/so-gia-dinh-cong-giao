<?php

namespace Database\Factories;

use App\Models\TenThanh;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenThanhFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TenThanh::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ten_thanh' => $this->faker->name(),
            'nguoi_khoi_tao' => rand(1,3),
        ];
    }
}
