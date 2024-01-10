<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_type = ['ADMIN', 'USERS'];
        return [
            'f_name' => $this->faker->name(),
            'l_name' => $this->faker->name(),
            'default_password' => $this->faker->name(),
            'email' => 'sayedahmad@gmail.com',
            'username' => 'admin',
            'type' => $user_type[rand(0,1)],
            'status' => 1,
            'admin_id' => 1, 
            'email_verified_at' => now(),
            'password' => '$2y$10$Jg115yot9aqnqASuWuNbLOOgVnT4m9u1Fdwj1vzZdNt5JTny8QGeu', // 12345678
            'remember_token' => Str::random(10),
        ];


    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
