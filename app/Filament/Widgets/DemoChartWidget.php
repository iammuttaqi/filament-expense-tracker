<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class DemoChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $current_year = Carbon::now()->year;

        $monthly_expenses = array_fill(1, 12, 0);
        $expenses = Expense::whereYear('date', $current_year)->where('user_id', auth()->user()->id)->get();

        foreach ($expenses as $expense) {
            $month = Carbon::parse($expense->date)->month; // Get month number (1-12)
            $monthly_expenses[$month] += $expense->amount; // Sum the amounts for each month
        }

        $monthly_incomes = array_fill(1, 12, 0);
        $incomes = Income::whereYear('date', $current_year)->where('user_id', auth()->user()->id)->get();

        foreach ($incomes as $income) {
            $month = Carbon::parse($income->date)->month; // Get month number (1-12)
            $monthly_incomes[$month] += $income->amount; // Sum the amounts for each month
        }

        return [
            'datasets' => [
                [
                    'label' => 'Expense in '.$current_year,
                    'data' => array_values($monthly_expenses),
                    'backgroundColor' => '#eab308',
                    'borderColor' => '#eab308',
                ],
                [
                    'label' => 'Income in '.$current_year,
                    'data' => array_values($monthly_incomes),
                    'backgroundColor' => '#22c55e',
                    'borderColor' => '#22c55e',
                ],
            ],
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';

        // 'Bar'
        // 'Bubble'
        // 'Doughnut'
        // 'Line'
        // 'Pie'
        // 'Polar'
        // 'Radar'
        // 'Scatter'
    }
}
