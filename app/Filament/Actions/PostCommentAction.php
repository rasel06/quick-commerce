<?php
// app/Filament/Actions/CommentAction.php
// app/Filament/Actions/CommentAction.php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class PostCommentAction
{
    public static function make(
        string $relationship = 'comments',
        string $bodyAttribute = 'body'
    ): Action {
        return Action::make('comment')
            ->label('Add Comment')
            ->icon('heroicon-o-chat-bubble-left-right')
            // ->color('info')
            ->modalHeading('Add Comment')
            ->modalSubmitActionLabel('Post Comment')
            ->schema([
                Textarea::make($bodyAttribute)
                    ->label('Comment')
                    ->required()
                    ->maxLength(1000)
                    ->rows(3),
            ])
            ->action(function (array $data, Model $record) use ($relationship, $bodyAttribute): void {
                $record->{$relationship}()->create([
                    $bodyAttribute => $data[$bodyAttribute],

                ]);

                Notification::make()
                    ->title('Comment added!')
                    ->success()
                    ->send();
            });
    }
}
