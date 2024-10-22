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

        $commodities = ['চাল', 'গম', 'জমির ধান', 'মটরশুঁটি', 'মসুর ডাল', 'ছোলার ডাল', 'কাবুলী চানা', 'সয়াবিন', 'ভুট্টা', 'বুট', 'পেঁয়াজ', 'রসুন', 'আলু', 'টমেটো', 'গাজর', 'শিমলা মরিচ', 'পালং শাক', 'গোকুল শাক', 'কচু', 'ঝিঙে', 'পেঁপে', 'কলা', 'আম', 'আমড়া', 'কাঁঠাল', 'লিচু', 'জাম', 'আপেল', 'কমলালেবু', 'মশলা', 'হলুদ', 'জিরা', 'ধনিয়া', 'মরিচ', 'কালোজিরা', 'লবণ', 'গোল মরিচ', 'আদা', 'ফুলকপি', 'মাছ', 'গরুর মাংস', 'মুরগির মাংস', 'ভেড়ার মাংস', 'ডিম', 'দুধ', 'মাখন', 'পনির', 'দই', 'তেল', 'সরিষার তেল', 'পাম তেল', 'সয়াবিন তেল', 'পাট', 'কাপড়', 'রাবার', 'তামাক', 'চামড়া', 'প্লাস্টিক পণ্য', 'সিমেন্ট', 'ইট', 'লোহা', 'স্টিল', 'গ্যাস', 'কাঠ', 'শুকনো ফল', 'মিষ্টি', 'জুস', 'হাইড্রোপনিক্স', 'শস্য', 'ভেজিটেবল', 'মাল্টি-গ্রেইন'];

        foreach ($users as $key => $user) {
            foreach (range(1, 700) as $key => $range) {
                $items = [
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
                    fake()->randomElement($commodities) => number_format(fake()->numberBetween(100, 500), 2),
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
