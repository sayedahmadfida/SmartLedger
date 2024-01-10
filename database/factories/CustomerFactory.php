<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_name' => $this->faker->name(),
            'customer_country' => $this->faker->address(3),
            'customer_province' => $this->faker->address(),
            'customer_village' => $this->faker->numberBetween($min = 2000, $max = 6000),
            'identity_card' => Str::random(10) ,
            'admin_id' => 1 ,
            'user_id' => 1
        ];
    }
}
