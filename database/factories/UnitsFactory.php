<?php

namespace Database\Factories;

use App\Models\Units;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Units::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Have To 50 Records!
        return [
            'main_name' => $this->faker->word,
             'short_name' => $this->faker->lexify('??'),
             'user_id' => 1,
             'admin_id' => 1
            ];

    }
}
