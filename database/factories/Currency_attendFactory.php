<?php

namespace Database\Factories;

use App\Models\Currency_attend;
use Illuminate\Database\Eloquent\Factories\Factory;

class Currency_attendFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency_attend::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'admin_id' => 1,
             'user_id' => 1
        ];
    }
}
