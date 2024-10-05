<?php

namespace App\Filament\Resources\IncomeCategoryResource\Pages;

use App\Filament\Resources\IncomeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIncomeCategories extends ManageRecords
{
    protected static string $resource = IncomeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
