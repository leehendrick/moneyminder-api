<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        \App\Models\TransactionType::factory(2)->create();

        \App\Models\Category::factory(5)
            ->recycle($users)
            ->create();

        \App\Models\Transaction::factory(20)
            ->recycle($users)
            ->create();

        //User::factory()->create([
        //   'name' => 'Test User',
        //   'email' => 'test@example.com',
        //]);
    }
}
