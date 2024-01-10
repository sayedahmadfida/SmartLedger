<?php

namespace Database\Factories;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;


class Sub_CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_category_name' => $this->faker->word(),
            'user_id' => 1,
            'admin_id' => 1,
            'category_id' => $this->faker->numberBetween($min = 1, $max = 20)
        ];
    }
}
