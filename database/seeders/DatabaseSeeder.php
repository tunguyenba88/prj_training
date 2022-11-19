<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(20)->create();

        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 1,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 1,
        ]);
        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 2,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 1,
        ]);
        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 3,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 1,
        ]);
        \App\Models\User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 3,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 1,
        ]);

        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 3,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 2,
        ]);

        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 3,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 2,
        ]);

        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 2,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 2,
        ]);

        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 3,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 3,
        ]);

        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 3,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 2,
        ]);

        \App\Models\User::factory(1)->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'birth_day' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'start_at' => fake()->unique()->dateTimeBetween('-7 days', '+2 months')->format('Y-m-d'),
            'status' => fake()->numberBetween($min = 1, $max = 2),
            'auth' => 2,
            'image' => '/images/default.jpeg',
            'phone' => Str::random(10),
            'room_id' => 2,
        ]);
        \App\Models\Room::factory(1)->create([
            'room_name' => fake()->name(),
            'manager_id' => 2,
        ]);

        \App\Models\Room::factory(1)->create([
            'room_name' => fake()->name(),
            'manager_id' => 7,
        ]);

        \App\Models\Room::factory(1)->create([
            'room_name' => fake()->name(),
            'manager_id' => 10,
        ]);
    }
}
