<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\Fieldset as ComponentsFieldset;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-m-newspaper';

    public static function contentBuilderField(string $context = 'form'): ComponentsBuilder
    {
        return ComponentsBuilder::make('content')->blocks([
            Block::make('heading')->schema([
                Grid::make($context === 'priview' ? 1 : 2)->schema([
                                 TextInput::make('title')
                                        ->label('Heading')
                                        ->required(),
                                    Select::make('level')
                                        ->options([
                                            'h1' => 'Heading 1',
                                            'h2' => 'Heading 2',
                                            'h3' => 'Heading 3',
                                            'h4' => 'Heading 4',
                                            'h5' => 'Heading 5',
                                            'h6' => 'Heading 6',
                                        ]),
                    Checkbox::make('uppercase')
                        ->columnSpanFull(),
                ]),

            ]),

                Block::make('paragraph')->schema([
                RichEditor::make('content')
                    ->toolbarButtons(['bold', 'italic']),
            ]),

        ])
            ->columnSpanFull()
            ->collapsible();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([

                Wizard::make([
                    Wizard\Step::make('Post')
                        ->schema([

                            Select::make('menu_id')->required()->label('Menu')
                                ->relationship(
                                    name: 'menu',
                                    modifyQueryUsing: fn (Builder $query) => $query->where('type', 'list'),
                                    titleAttribute: 'name')
                                ->live(onBlur: true)
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $menu = \App\Models\Menu::find($state);
                                    if ($menu) {
                                        // $set('slug', $menu->slug); // Set hasil query
                                        $set('sub_title', $menu->name); // Set hasil query
                                    }
                                }),

                            // ->createOptionForm([
                            //     Forms\Components\TextInput::make('title')
                            //         ->required(),
                            //     Forms\Components\TextInput::make('desc')
                            //         ->required()
                            // ]),
                        ]),
                    Wizard\Step::make('Description')
                        ->schema([
                            TextInput::make('title')->live(onBlur: true)->required()->columnSpanFull()->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            TextInput::make('sub_title'),
                            Hidden::make('created_by')->default(auth()->user()->id),
                            Hidden::make('slug'),
                            DatePicker::make('published_at')->required(),
                            Select::make('categori_id')->relationship('categori', 'name')->preload()->searchable(),
                            // RichEditor::make('content')->columnSpanFull()->required(),
                        ])->columns(2),
                    Wizard\Step::make('Content')
                        ->schema([
                            Actions::make([
                                InlinePreviewAction::make()
                                    ->label('Preview Content Blocks')
                                    ->builderName('content'),
                            ])
                                ->columnSpanFull()
                                ->alignEnd(),
                                self::contentBuilderField(),

                        ]),
                    ]),
                Split::make([

                    Fieldset::make('Status')
                    ->schema([
                        Toggle::make('is_active')->required(),
                        Toggle::make('is_featured'),
                        // DateTimePicker::make('published_at')
                        // ->hidden(fn (Get $get) => $get('status') !== 'published'),
                    ])->grow(false),
                ])->from('md'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->striped()
            ->columns([
                //
                TextColumn::make('title'),
                // TextColumn::make('content'),
                TextColumn::make('categori.name')->sortable()->badge()->color('gray')->searchable(),
                TextColumn::make('menu.name')->sortable()->badge()->color('secondary')->searchable()->label('Type'),
                ToggleColumn::make('is_active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(false),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getHeaderWidgets(): array
    {
        return [
            //
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ComponentsFieldset::make('Content')
                ->schema([
                    RepeatableEntry::make('content')
                    ->schema([
                      KeyValueEntry::make('content')->keyLabel('type')->valueLabel('data')
                    ]),
                ])->columns(1),
                ComponentsFieldset::make('Judul')
                ->schema([
                    TextEntry::make('title')
                    ->weight(FontWeight::Bold),
                ])->columns(1),
                ComponentsFieldset::make('Info Content')
                ->schema([
                    TextEntry::make('categori.name')->badge()->color('gray'),
                    TextEntry::make('menu.name')->badge()->color('secondary')->label('Type'),
                    IconEntry::make('is_active')->trueIcon('heroicon-o-check-circle')->falseIcon('heroicon-o-x-circle')->trueColor('success')->falseColor('danger'),
            ])->columns(3)->grow(false),




            ]);
    }
}
