<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'monthly_limit' => $this->faker->randomFloat(2, 10, 100),
            'user_id' => User::factory(),
            'is_default' => $this->faker->boolean(),
        ];
    }
}
