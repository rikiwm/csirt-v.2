<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Menu;
use App\Models\Page;
use Attribute;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms;
// use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Tabs::make('Tabs')->contained(false)
                ->tabs([
                    Tabs\Tab::make('Tab 1')
                        ->schema([
                            Wizard::make([
                                Wizard\Step::make('Name Menu')
                                    ->beforeValidation(function ($state, $component) {
                                        if (empty($state['menu_id'])) {
                                            Notification::make('Menu is empty')->danger()->title('Error')->send();
                                            return $state;
                                        }
                                    })

                                    ->schema([
                                        Select::make('menu_id')->required()->label('Menus')->selectablePlaceholder(true)
                                            ->relationship(
                                                name: 'menus',
                                                modifyQueryUsing: fn (Builder $query) => $query->where('type', 'page')->whereNotIn('id', Page::query()->pluck('menu_id')->toArray()),
                                                titleAttribute: 'name')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                $menu = \App\Models\Menu::find($state);
                                                if ($menu) {
                                                    $set('slug', $menu->slug); // Set hasil query
                                                    $set('title', $menu->name); // Set hasil query
                                                }
                                            }),

                                        Fieldset::make('Roles')
                                            ->schema([
                                                Placeholder::make('Roles Selected Menus')
                                                ->content( 'Desc')
                                            ]),

                                    ]),
                                Wizard\Step::make('Content')
                                    ->schema([
                                        TextInput::make('title'),
                                        Hidden::make('created_by')->default(auth()->user()->id),
                                        Hidden::make('slug'),
                                        DatePicker::make('publish_at'),
                                        TextInput::make('is_active'),
                                        Select::make('categori_id')->relationship('category', 'name')->preload()->searchable(),
                                    ]),

                            ])
                        ]),
                    Tabs\Tab::make('Tab 2')
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
                //

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('title'),
                TextColumn::make('created_at')->since()
                ->dateTimeTooltip(),
                // TextColumn::make('content')->html(true)->limit(100),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
