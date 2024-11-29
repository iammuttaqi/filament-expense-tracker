<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\IncomeResource\Pages;
use App\Models\Income;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('income_category_id')
                    ->required()
                    ->relationship(name: 'income_category', titleAttribute: 'title', modifyQueryUsing: fn ($query) => $query->where('user_id', auth()->user()->id))
                    ->searchable()
                    ->preload()
                    ->columnSpanFull()
                    ->placeholder(__('Income Category')),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->placeholder(__('Date'))
                    ->default(now())
                    ->native(false),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->prefix('৳')
                    ->placeholder(__('Amount')),
                Forms\Components\Textarea::make('note')
                    ->columnSpanFull()
                    ->placeholder(__('Note')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->where('user_id', auth()->user()->id))
            ->columns([
                Tables\Columns\TextColumn::make('income_category.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc')
            ->defaultPaginationPageOption(50);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageIncomes::route('/'),
        ];
    }
}
