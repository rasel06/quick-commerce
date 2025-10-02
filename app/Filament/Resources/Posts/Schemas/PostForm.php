<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Action::make('Add More')
                    ->steps([
                        Step::make('Name')
                            ->description('Give the category a unique name')
                            ->schema([
                                TextInput::make('name')
                                    ->required(),
                                // ->live()
                                // ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    // ->disabled()
                                    ->required()
                                    ->unique(User::class, 'name'),
                            ])
                            ->columns(2),
                        Step::make('Description')
                            ->description('Add some extra details')
                            ->schema([
                                MarkdownEditor::make('description'),
                            ]),
                        Step::make('Visibility')
                            ->description('Control who can view it')
                            ->schema([
                                Toggle::make('is_visible')
                                    ->label('Visible to customers.')
                                    ->default(true),
                            ]),
                    ])
                    ->action(function (array $data): void {
                        $rand = random_int(1, 1000);
                        User::create([
                            'name' => $data['name'],
                            'email' => "email_" . $rand . "@gmail.com",
                            'password' => '123123'

                            // 'slug' => $data['slug'],
                            // 'description' => $data['description'] ?? null,
                            // 'is_visible' => (bool) ($data['is_visible'] ?? false),
                        ]);

                        // Optional: Notify user
                        //Notification()->success('Category created successfully!');
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('User created')
                            ->body('The user has been created successfully.')
                    ),

                Grid::make()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        Toggle::make("is_published")
                            ->label('Published')
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

                        Select::make('created_by')
                            ->label('Author')
                            ->options(User::query()->pluck('name', 'id'))
                            ->searchable()
                            ->relationship('creator', 'name')
                            // ->live()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(User::class, 'name'),
                            ])
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
                        MarkdownEditor::make('content')
                            ->required()
                            ->maxLength(500)
                            ->maxHeight(10)
                            ->columnSpanFull(),
                    ]),

                // 'title', 'content', 'is_published'


            ]);
    }
}
