<?php

namespace App\Filament\User\Resources\IncomeCategoryResource\Pages;

use App\Filament\User\Resources\IncomeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIncomeCategories extends ManageRecords
{
    protected static string $resource = IncomeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();

                    return $data;
                }),
        ];
    }
}
