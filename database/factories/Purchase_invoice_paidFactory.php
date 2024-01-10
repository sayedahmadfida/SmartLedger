<?php

namespace Database\Factories;

use App\Models\Purchase_invoice_paid;
use Illuminate\Database\Eloquent\Factories\Factory;

class Purchase_invoice_paidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase_invoice_paid::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paid_type = ['CRIDET', 'DEBIT'];

        return [
            'paid_type' => 'DEBIT',
            'currency_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'purchase_invoice_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'payment_datails_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'paid_amount' => $this->faker->numberBetween($min = 999, $max = 99999),
            'ltd_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'money_resources_id' => 1,
            'paid_description'  => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'user_id' => 1,
            'admin_id' => 1,
        ];
    }
}
