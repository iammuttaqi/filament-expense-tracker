<?php

namespace App\Filament\User\Pages;

use App\Models\Expense;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
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
        $itemsWithDates = Expense::select('items', 'date')
            ->get()
            ->flatMap(function ($expense) {
                return collect($expense->items)->map(function ($price, $title) use ($expense) {
                    return [
                        'title' => $title,
                        'price' => $price,
                        'date'  => $expense->date,
                    ];
                });
            })
            ->groupBy('title')
            ->map(function ($group) {
                return $group->sortByDesc('date')->first();
            })
            ->filter(function ($item) {
                return stripos($item['title'], $this->query) !== false;
            })
            ->values();

        return [
            'items' => $itemsWithDates,
        ];
    }
}
