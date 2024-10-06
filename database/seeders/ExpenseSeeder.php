<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        foreach (range(1, 1000) as $key => $range) {
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
                'expense_category_id' => fake()->randomElement(ExpenseCategory::pluck('id')->toArray()),
                'date' => $date,
                'amount' => $amount,
                'items' => json_encode($items),
                'note' => fake()->boolean() ? fake()->text() : null,

                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        Expense::insert($data);
    }
}
