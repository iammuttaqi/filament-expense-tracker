<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        foreach (range(1, 500) as $key => $range) {
            $date = fake()->dateTimeBetween(startDate: '2021-01-01', endDate: 'now');
            $data[] = [
                'income_category_id' => fake()->randomElement(IncomeCategory::pluck('id')->toArray()),
                'date' => $date,
                'amount' => fake()->numberBetween(2000, 5000),
                'note' => fake()->boolean() ? fake()->text() : null,

                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        Income::insert($data);
    }
}
