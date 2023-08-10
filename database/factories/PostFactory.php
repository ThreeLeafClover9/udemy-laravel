<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'is_admin' => $this->faker->boolean(),
            'path' => $this->faker->imageUrl(),

            'user_id' => User::factory(),
        ];
    }
}
