<?php

namespace Database\Factories;

use App\Models\Purchase_invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class Purchase_invoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase_invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ltd_id' =>$this->faker->numberBetween($min = 1, $max = 100),
             'currency_id' =>$this->faker->numberBetween($min = 1, $max = 3),
             'invoice_number' =>$this->faker->numberBetween($min = 999, $max = 5999),
             'total' =>$this->faker->numberBetween($min = 999, $max = 99999),
            'is_returned'  => 0,
            'user_id' =>  1,
             'admin_id'  => 1,
             'created_at' =>  $this->faker->date($format = 'Y-m-d', $max = 'now'),

        ];
    }
}
