<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 'title', 'content', 'is_published'
                // Display only first 50 characters of content
                TextColumn::make('title')
                    ->label('Title')
                    ->limit(20)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('content')
                    ->label('Content')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_published')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedCheckBadge)
                    ->falseIcon(Heroicon::OutlinedXMark),
                TextColumn::make("creator.name")
                    ->label('Creator')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),
                TextColumn::make("editor.name")
                    ->label('Editor')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),

                // Stack::make([
                //     TextColumn::make('phone')
                //         ->icon('heroicon-m-phone'),
                //     TextColumn::make('email')
                //         ->icon('heroicon-m-envelope'),
                // ]),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->since(),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                //
            ])

            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
            ->recordActions([
                // EditAction::make(),
                // DeleteAction::make(),
            ]);
    }
}
