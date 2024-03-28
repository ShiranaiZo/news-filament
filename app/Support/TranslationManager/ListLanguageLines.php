<?php

namespace App\Support\TranslationManager;

use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Kenepa\TranslationManager\Actions\SynchronizeAction;
// use Kenepa\TranslationManager\Resources\LanguageLineResource;
use Kenepa\TranslationManager\Resources\LanguageLineResource\Pages\ListLanguageLines as Resource;

class ListLanguageLines extends Resource
{
    protected static string $resource = LanguageLineResource::class;

    public function synchronize(): void
    {
        SynchronizeAction::run($this);
    }

    public function getTranslationPreview($record, $maxLength = null)
    {
        $transParameter = "{$record->group}.{$record->key}";
        $translated = trans($transParameter);

        if ($maxLength) {
            $translated = (strlen($translated) > $maxLength) ? substr($translated, 0, $maxLength) . '...' : $translated;
        }

        return $translated;
    }

    protected function getActions(): array
    {
        return [
            Action::make('quick-translate')
                ->icon('heroicon-o-bolt')
                ->label(__('translations.quick-translate'))
                ->url(LanguageLineResource::getUrl('quick-translate')),

            // SynchronizeAction::make('synchronize')
            //     ->action('synchronize'),
        ];
    }
}
