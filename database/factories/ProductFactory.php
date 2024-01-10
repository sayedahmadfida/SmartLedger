<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->word(),
            'sub_category_id' => $this->faker->numberBetween($min = 1, $max = 50 ),
            'alert_quantity' => $this->faker->numberBetween($min = 1, $max = 5),
            'user_id' => 1,
            'unite_id' => $this->faker->numberBetween($min = 1, $max = 50 ),
            'admin_id' => 1

        ];
    }
}
