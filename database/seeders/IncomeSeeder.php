<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $data = [];

        // Start date and end date
        $startDate = Carbon::createFromDate(2021, 1, 1);
        $endDate = Carbon::createFromDate(now());

        // Loop through each month
        foreach ($users as $key => $user) {
            foreach (new \DatePeriod($startDate, new \DateInterval('P1M'), $endDate) as $date) {
                $data[] = [
                    'user_id' => $user->id,
                    'income_category_id' => fake()->randomElement(IncomeCategory::pluck('id')->toArray()),
                    'date' => Carbon::parse($date)->startOfMonth(), // First day of the month
                    'amount' => fake()->numberBetween(50000, 50000), // Generate a fixed amount (50,000)
                    'note' => fake()->boolean() ? fake()->text() : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert the data into the database
        foreach (array_chunk($data, 2000) as $key => $chunk) {
            Income::insert($data);
        }
    }
}
