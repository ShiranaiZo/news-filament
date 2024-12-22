<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgeCategoryResource\Pages;
use App\Filament\Resources\AgeCategoryResource\RelationManagers;
use App\Models\AgeCategory;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgeCategoryResource extends Resource
{
    protected static ?string $model = AgeCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Is active?')
                    ->default(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('admin.name'))
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueColor('success')
                    ->sortable(),
                TextColumn::make('user.email')
                    ->label('Created by')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgeCategories::route('/'),
            'create' => Pages\CreateAgeCategory::route('/create'),
            'edit' => Pages\EditAgeCategory::route('/{record}/edit'),
        ];
    }
}
