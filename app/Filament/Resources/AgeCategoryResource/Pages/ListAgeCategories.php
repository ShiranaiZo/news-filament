<?php

namespace App\Filament\Resources\AgeCategoryResource\Pages;

use App\Filament\Resources\AgeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgeCategories extends ListRecords
{
    protected static string $resource = AgeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
