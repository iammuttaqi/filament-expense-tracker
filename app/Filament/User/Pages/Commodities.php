<?php

namespace App\Filament\User\Pages;

use App\Models\Expense;
use Filament\Pages\Page;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Commodities extends Page
{
    use WithPagination;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.commodities';

    #[Url()]
    public $query = '';

    public function search() {}

    public function getViewData(): array
    {
        $items_with_dates = Expense::select('items', 'date')
            ->where('user_id', auth()->user()->id)
            ->get()
            ->flatMap(function ($expense) {
                return collect($expense->items)->map(function ($price, $title) use ($expense) {
                    return [
                        'title' => strtolower(trim($title)),
                        'price' => $price,
                        'date' => $expense->date,
                    ];
                });
            })
            ->groupBy('title')
            ->map(function ($group) {
                return $group->sortByDesc('date')->first();
            })
            ->filter(function ($item) {
                return is_numeric($item['price']) && stripos($item['title'], strtolower($this->query)) !== false;
            })
            ->map(function ($item) {
                $item['title'] = str()->headline($item['title']);

                return $item;
            })
            ->values();

        return [
            'items' => $items_with_dates,
        ];
    }
}
