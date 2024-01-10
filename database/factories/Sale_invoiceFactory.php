<?php

namespace Database\Factories;

use App\Models\Sale_invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class Sale_invoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale_invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' =>$this->faker->numberBetween($min = 1, $max = 100),
            'currency_id' =>$this->faker->numberBetween($min = 1, $max = 3),
            'bill_number' =>$this->faker->numberBetween($min = 999, $max = 5999),
            'bill_unique_number' => 1,
            'total_amount'  =>$this->faker->numberBetween($min = 999, $max = 99999),
            'is_returned' => 0,
            'user_id' => 1,
            'admin_id' => 1
        ];

    }
}
