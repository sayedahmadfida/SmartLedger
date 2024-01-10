<?php

namespace Database\Factories;

use App\Models\In_Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class In_StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = In_Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'warehouse_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'company_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'currency_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'quantity' => $this->faker->numberBetween($min = 10, $max = 210),
            'unit_cost' => $this->faker->numberBetween($min = 500, $max = 2000),
            'price' => $this->faker->numberBetween($min = 500, $max = 2000),
            // 'sale_price' => $this->faker->numberBetween($min = 500, $max = 2000),
            'user_id' => 1,
            'admin_id' => 1
        ];

    }
}
