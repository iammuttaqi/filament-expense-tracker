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
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);

        User::factory(2)->create([
            'role' => 'user',
        ]);

        $this->call([
            ExpenseCategorySeeder::class,
            IncomeCategorySeeder::class,

            ExpenseSeeder::class,
            IncomeSeeder::class,
        ]);
    }
}
