<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        // dd(request()->route()->getName());
        return $table
            ->heading(__('admin.posts'))
            ->defaultSort('updated_at', 'desc')
            ->columns([
                TextColumn::make('no')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                ImageColumn::make('cover')
                    ->label(__('admin.cover')),
                TextColumn::make('title')
                    ->label(__('admin.title'))
                    ->searchable()
                    ->sortable(),
                IconColumn::make('status')
                    ->label(__('admin.publish'))
                    ->boolean()
                    ->trueColor('success')
                    ->sortable(),
                ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                ViewAction::make()
                    ->label('')
                    ->tooltip(__('view'))
                    ->url(
                        fn (Post $record): string => route('filament.admin.resources.posts.view', [$record]),
                    )
                    ->openUrlInNewTab(),

                // Tables\Actions\Action::make('view-x')
                //     ->icon('heroicon-o-eye')
                //     ->label('')
                //     ->url(
                //         function ($record){
                //             PostResource::getUrl('view', [$record]);
                //         }
                //     ),
            ])
            ->headerActions([
                Tables\Actions\Action::make('create-x')
                    ->label(__('admin.new post'))
                    ->url(PostResource::getUrl('create', [
                        'category_id' => $this->ownerRecord->id,
                    ])),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
