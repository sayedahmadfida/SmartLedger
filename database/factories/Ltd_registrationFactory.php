<?php

namespace Database\Factories;

use App\Models\Ltd_registration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class Ltd_registrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ltd_registration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ltd_name' => $this->faker->name(),
            'ltd_country' => $this->faker->address(),
            'ltd_province' => $this->faker->name(),
            'ltd_street' => $this->faker->name(),
            'ltd_shop' => $this->faker->numberBetween($min = 2000, $max = 6000),
            'user_id' => 1,
            'admin_id' => 1,
        ];
    }
}
