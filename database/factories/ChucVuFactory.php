<?php

namespace Database\Factories;

use App\Models\ChucVu;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChucVuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChucVu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ten_chuc_vu' => $this->faker->name(),
            'nguoi_khoi_tao' => rand(1,3),
        ];
    }
}
