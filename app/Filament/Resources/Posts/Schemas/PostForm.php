<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 'title', 'content', 'is_published'
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                MarkdownEditor::make('content')
                    ->required()
                    ->maxLength(65535),
                Checkbox::make('is_published')
                    ->label('Is Published')
                    ->default(false),

            ]);
    }
}
