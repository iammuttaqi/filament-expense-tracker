<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $data = [];

        foreach ($users as $key => $user) {
            foreach (range(1, 700) as $key => $range) {
                $items = [
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                    fake()->word() => fake()->numberBetween(100, 500),
                ];
                $amount = collect($items)->values()->sum();
                $date = fake()->dateTimeBetween(startDate: '2021-01-01', endDate: 'now');

                $data[] = [
                    'user_id' => $user->id,
                    'expense_category_id' => fake()->randomElement(ExpenseCategory::pluck('id')->toArray()),
                    'date' => $date,
                    'amount' => $amount,
                    'items' => json_encode($items),
                    'note' => fake()->boolean() ? fake()->text() : null,

                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }
        }

        foreach (array_chunk($data, 2000) as $key => $chunk) {
            Expense::insert($chunk);
        }
    }
}
