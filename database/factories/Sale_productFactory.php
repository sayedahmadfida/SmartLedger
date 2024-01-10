<?php

namespace Database\Factories;

use App\Models\Sale_product;
use Illuminate\Database\Eloquent\Factories\Factory;

class Sale_productFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale_product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_id' =>$this->faker->numberBetween($min = 1, $max = 100),
            'currency_id' =>$this->faker->numberBetween($min = 1, $max = 3),
            'product_id' =>$this->faker->numberBetween($min = 1, $max = 50),
            'warehouse_id' =>$this->faker->numberBetween($min = 1, $max = 50),
            'sales_product_description'  => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
           'quantity' =>$this->faker->numberBetween($min = 1, $max = 50),
            'price' => $this->faker->numberBetween($min = 500, $max = 2000),
            'grand_total' =>  $this->faker->numberBetween($min = 999, $max = 99999),
            'discount' =>  $this->faker->numberBetween($min = 1, $max = 20),
            'profit' => $this->faker->numberBetween($min = 500, $max = 2000),
            'in_stock_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'user_id' => 1,
            'admin_id' => 1,
        ];
    }
}
