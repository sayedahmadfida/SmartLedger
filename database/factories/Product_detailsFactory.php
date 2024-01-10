<?php

namespace Database\Factories;

use App\Models\Product_details;
use Illuminate\Database\Eloquent\Factories\Factory;

class Product_detailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product_details::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return
        [
        'product_id' =>$this->faker->numberBetween($min = 1, $max = 50),
         'currency_id' =>$this->faker->numberBetween($min = 1, $max = 3),
          'warehouse_id' =>$this->faker->numberBetween($min = 1, $max = 50),
           'company_id' =>$this->faker->numberBetween($min = 1, $max = 50),
           'employee_id' => 1,
           'invoice_id' =>$this->faker->numberBetween($min = 1, $max = 50),
           'in_stoke_id' =>$this->faker->numberBetween($min = 1, $max = 50),
           'quantity' =>$this->faker->numberBetween($min = 1, $max = 50),
            'price' => $this->faker->numberBetween($min = 500, $max = 2000),
            'sale_price' =>  $this->faker->numberBetween($min = 500, $max = 2000),
            'grand_total' =>  $this->faker->numberBetween($min = 999, $max = 99999),
            'discount' =>  $this->faker->numberBetween($min = 1, $max = 20),
            'expire_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'admin_id' => 1,
             'user_id' => 1
            ];
    }
}