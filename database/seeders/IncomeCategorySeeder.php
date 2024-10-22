<?php

namespace Database\Seeders;

use App\Models\IncomeCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $pre_categories = ['Salary', 'Business Income', 'Freelance Income', 'Investment Income', 'Rental Income', 'Interest Income', 'Dividends', 'Capital Gains', 'Royalties', 'Bonuses', 'Commission', 'Pension', 'Annuities', 'Social Security', 'Inheritance', 'Gifts', 'Grants', 'Subsidies', 'Refunds', 'Other Income'];

        $categories = [];
        foreach ($users as $key => $user) {
            foreach ($pre_categories as $key => $pre_category) {
                $categories[] = [
                    'user_id' => $user->id,
                    'title' => Str::headline($pre_category),
                    'slug' => Str::slug($user->name . '-' . $pre_category . '-' . $user->id),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        IncomeCategory::insert($categories);
    }
}
