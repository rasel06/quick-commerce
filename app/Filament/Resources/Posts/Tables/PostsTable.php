<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
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
                    ->sortable()
                    ->searchable(),
                TextColumn::make('content')
                    ->label('Content')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_published')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedCheckBadge)
                    ->falseIcon(Heroicon::OutlinedXMark),
                // IconColumn::make('is_published')
                //     ->label('Published')
                //     ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
