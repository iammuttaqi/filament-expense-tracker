<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $income_this_month = Income::where('user_id', auth()->user()->id)->whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->sum('amount');
        $expense_this_month = Expense::where('user_id', auth()->user()->id)->whereYear('date', Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->sum('amount');

        $remaining_amount = $income_this_month - $expense_this_month;

        $remaining_budget_label = $remaining_amount < 0 ? 'Overspent by ' . number_format(abs($remaining_amount), 2) : 'Remaining: ' . number_format($remaining_amount, 2);
        $remaining_budget_color = $remaining_amount < 0 ? 'danger' : 'success';

        return [
            Stat::make('Incomes This Month', number_format($income_this_month, 2)),
            Stat::make('Expense This Month', number_format($expense_this_month, 2))->description($remaining_budget_label)->color($remaining_budget_color),
        ];
    }
}
