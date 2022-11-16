<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => fake()->numberBetween($min = 2, $max = 2),
            'image' => Str::random(10),
            'phone' => Str::random(10),
            'id_phong' => fake()->numberBetween($min = 3, $max = 3),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
