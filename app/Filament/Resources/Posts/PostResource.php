<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    //protected static ?string $navigationLabel = 'Custom Navigation Label';

    // protected ?string $heading = 'Custom Page Heading';
    // protected ?string $subheading = 'Custom Page Subheading';

    //protected static ?string $recordTitleAttribute = 'title';
    protected ?bool $hasDatabaseTransactions = true;

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function getNavigationSort(): int
    {
        return 1; // Lower = higher priority
    }

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table)
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
                // EditAction::make()
                //     ->iconButton()
                //     ->color('success')
                //     ->modalHeading('Edit Post')
                //     ->modalSubmitActionLabel('Save Changes')
                //     ->successNotification(
                //         Notification::make()
                //             ->success()
                //             ->title('Post updated')
                //             ->body('The post has been updated successfully.')
                //     )
                //     ->modalWidth(Width::ExtraLarge)
                //     ->closeModalByClickingAway(false),
                // DeleteAction::make()
                //     ->iconButton()
                //     ->closeModalByClickingAway(false)
                //     ->visible(
                //         fn(Post $record): bool =>
                //          auth()->check() &&
                //             $record->created_by === auth()->id()
                //             // &&
                //             // auth()->user()->can('post.delete')
                //     ),
            ])
            ->headerActions([
                CreateAction::make()
                    ->icon('heroicon-m-plus-circle')
                    ->iconButton()
                    ->size('xl') // Large icon button
                    ->color('primary') //
                    ->outlined() // Outline style
                    ->modalHeading('Create New Post')
                    ->modalSubmitActionLabel('Create Post')
                    ->modalWidth(Width::ExtraLarge)
                    ->closeModalByClickingAway(false)
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Post created')
                            ->body('The post has been created successfully.')
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Bulk delete with confirmation
                    DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Delete selected posts')
                        ->modalDescription('Are you sure you want to delete the selected posts? This action cannot be undone.')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Posts deleted')
                                ->body('The selected posts have been deleted successfully.')
                        ),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            // 'create' => CreatePost::route('/create'),
            // 'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
