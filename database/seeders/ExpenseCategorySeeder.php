<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $pre_categories = ['Rent', 'Utilities', 'Groceries', 'Transportation', 'Healthcare', 'Insurance', 'Debt Payments', 'Entertainment', 'Dining Out', 'Clothing', 'Education', 'Childcare', 'Subscriptions', 'Savings & Investments', 'Taxes', 'Gifts & Donations', 'Maintenance & Repairs', 'Travel', 'Office Supplies', 'Miscellaneous'];

        $categories = [];
        foreach ($users as $key => $user) {
            foreach ($pre_categories as $key => $pre_category) {
                $categories[] = [
                    'user_id' => $user->id,
                    'title' => Str::headline($pre_category),
                    'slug' => Str::slug($user->name.'-'.$pre_category.'-'.$user->id),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        ExpenseCategory::insert($categories);
    }
}
