<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->randomFloat(2, 10, 100),
            'date' => $this->faker->date(),
            'description' => $this->faker->text(),
            'transaction_type_id' => TransactionType::factory(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
