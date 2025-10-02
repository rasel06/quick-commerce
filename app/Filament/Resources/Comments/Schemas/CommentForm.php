<?php

namespace App\Filament\Resources\Comments\Schemas;

use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(1)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('post_id')
                            ->label('Post')
                            ->options(Post::query()->pluck('title', 'id'))
                            ->searchable()
                            ->relationship('post', 'title')
                            ->preload(false)
                            ->required(),
                        TextInput::make('comment')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        Toggle::make("is_approved")
                            ->label('Approved')
                            ->default(false)
                            ->columnSpan(1),

                        // Select::make('division_id')
                        //     ->label('Division')
                        //     ->relationship('creator', 'name')
                        //     ->searchable()
                        //     ->createOptionForm([
                        //         TextInput::make('name')
                        //             ->label('Division Name')
                        //             ->required()
                        //             ->maxLength(255)
                        //             ->unique(User::class, 'name'),
                        //     ]),

                        Select::make('approved_by')
                            ->label('Approver')
                            ->options(User::query()->pluck('name', 'id'))
                            ->searchable()
                            ->relationship('approver', 'name')
                            // ->live()
                            // ->createOptionForm([
                            //     TextInput::make('name')
                            //         ->required()
                            //         ->maxLength(255)
                            //         ->unique(User::class, 'name'),
                            // ])
                            ->preload(false)
                            ->required(),
                        // Select::make("is_published")
                        //     ->options([
                        //         false => 'Not Published',
                        //         true => 'Published'
                        //     ])
                        //     ->default(false)
                        //     ->native(false)
                        //     ->columnSpan(1),

                    ]),
            ]);
    }
}
