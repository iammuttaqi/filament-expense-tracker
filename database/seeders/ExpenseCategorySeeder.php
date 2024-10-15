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
        $categories = [];

        foreach ($users as $key => $user) {
            foreach (range(1, 10) as $key => $range) {
                $title = fake()->words(nb: 2, asText: true);
                $categories[] = [
                    'user_id' => $user->id,
                    'title' => Str::headline($title),
                    'slug' => Str::slug($user->name.'-'.$title.'-'.$user->id),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        ExpenseCategory::insert($categories);
    }
}
