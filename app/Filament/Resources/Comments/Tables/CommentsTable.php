<?php

namespace App\Filament\Resources\Comments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('post.title')
                    ->label('Post')
                    ->limit(20)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('comment')
                    ->label('Comment')
                    ->limit(20)
                    ->sortable()
                    ->searchable(),

                IconColumn::make('is_approved')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedCheckBadge)
                    ->falseIcon(Heroicon::OutlinedXMark),
                TextColumn::make("commenter.name")
                    ->label('Commenter')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),
                TextColumn::make("approver.name")
                    ->label('Approver')
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
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
