<?php

namespace App\Filament\User\Pages;

use App\Models\Expense;
use Carbon\Carbon;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;

class CommoditiesShow extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.user.pages.commodities-show';

    protected static ?string $title = 'Commodity Show';

    public function mount()
    {
        static::$title = request()->item;

        $expenses = Expense::where('user_id', auth()->user()->id)->get();
        $filtered_expenses = $expenses->filter(function ($expense) {
            return array_key_exists(static::$title, $expense->items);
        })->values();

        $this->latest_price = number_format(collect($filtered_expenses)->sortByDesc('date')->first()?->items[static::$title] ?? 0, 2);
        $this->average_price = number_format(collect($filtered_expenses)->avg(fn($expense) => $expense->items[static::$title]), 2);
        $this->recent_prices = collect($filtered_expenses)->sortByDesc('date')->take(10)->pluck('items.' . static::$title, 'date')
            ->mapWithKeys(function ($recent_price, $date) {
                $formatted_date = Carbon::parse($date)->format('Y-m-d | h:i A');
                return [$formatted_date => 'Tk. ' . number_format($recent_price, 2)];
            });
    }

    public $latest_price;
    public $average_price;
    public $recent_prices;

    public function itemInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'latest_price' => $this->latest_price,
                'average_price' => $this->average_price,
                'recent_prices' => $this->recent_prices,
            ])
            ->schema([
                Fieldset::make('Latest Price')->label(false)->schema([
                    TextEntry::make('latest_price')->prefix('Tk. ')->size(TextEntrySize::Large)->weight(FontWeight::Bold)->fontFamily(FontFamily::Mono),
                    TextEntry::make('average_price')->prefix('Tk. ')->size(TextEntrySize::Large)->weight(FontWeight::Bold)->fontFamily(FontFamily::Mono),
                ]),
                KeyValueEntry::make('recent_prices')->keyLabel('Date and Time')->valueLabel('Price')->columnSpanFull(),
            ]);
    }
}
