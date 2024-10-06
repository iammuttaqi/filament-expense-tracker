<?php

namespace Database\Seeders;

use App\Models\IncomeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];

        foreach (range(1, 10) as $key => $range) {
            $title = fake()->words(nb: 2, asText: true);
            $categories[] = [
                'title' => Str::headline($title),
                'slug' => Str::slug($title),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        IncomeCategory::insert($categories);
    }
}
