<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warehouse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 50 Records
        return [
            'warehouse_name' =>  $this->faker->name(),
            'warehouse_address' =>  $this->faker->streetAddress(),
            'user_id' => 1,
            'admin_id' => 1,
        ];
    }
}
