<?php
// app/Filament/Actions/CreateRelatedRecordAction.php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Forms\ComponentContainer;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class CreateRelatedRecordAction
{
    /**
     * @param string $relationship E.g., 'comments'
     * @param array $formSchema Filament form components
     * @param string $submitLabel Button label
     */
    public static function make(
        string $relationship = "",
        array $formSchema = [],
        string $submitLabel = 'Create'


    ): Action {
        return Action::make('create_' . $relationship)
            ->label($submitLabel)
            ->icon('heroicon-o-plus')
            ->modalHeading("Add " . ucfirst(str_replace('_', ' ', $relationship)))
            ->modalSubmitActionLabel($submitLabel)
            ->schema($formSchema)
            ->action(function (array $data, Model $record) use ($relationship, $submitLabel): void {

                $record->{$relationship}()->create($data);

                Notification::make()
                    ->title(ucfirst($submitLabel) . ' successful!')
                    ->success()
                    ->send();
            });
    }
}
