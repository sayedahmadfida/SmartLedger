<?php

namespace Database\Factories;

use App\Models\Customer_invoice_paid;
use Illuminate\Database\Eloquent\Factories\Factory;

class Customer_invoice_paidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer_invoice_paid::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_type = ['DEBIT', 'CREDIT'];

        return [
            'paid_type' =>  $user_type[rand(0,1)],
            'currency_id' =>$this->faker->numberBetween($min = 1, $max = 3),
            'sale_invoice_id' =>$this->faker->numberBetween($min = 1, $max = 100),
            'paid_amount' =>$this->faker->numberBetween($min = 999, $max = 99999),
            'customer_id' =>$this->faker->numberBetween($min = 1, $max = 100),
            'money_resources_id' => 1,
            'payment_datails_id' =>$this->faker->numberBetween($min = 1, $max = 50),
            'paid_description'  => $this->faker->realText($maxNbChars = 100, $indexSize = 2),
            'user_id' => 1,
            'admin_id' => 1
        ];

    }
}
