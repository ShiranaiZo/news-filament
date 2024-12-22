<?php

namespace App\Filament\Resources\AgeCategoryResource\Pages;

use App\Filament\Resources\AgeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgeCategory extends EditRecord
{
    protected static string $resource = AgeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
