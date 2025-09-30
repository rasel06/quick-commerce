<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        Select::make("is_published")
                            ->options([
                                false => 'Not Published',
                                true => 'Published'
                            ])
                            ->default(false)
                            ->native(false)
                            ->columnSpan(1),
                        MarkdownEditor::make('content')
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                // 'title', 'content', 'is_published'


            ]);
    }
}
