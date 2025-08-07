<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Faker\Provider\Lorem;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\IconEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Forms\Set;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-m-rectangle-group';



    protected function BeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);
        return $data;
    }

    public static function form(Form $form): Form
    {
        return $form

        ->columns([
            'default' => 1,
            'lg' => 1,
            'xl' => 1,
            '2xl' => 1
        ])
            ->schema([
                Section::make('Instructions')->icon('heroicon-o-document-text')->collapsible()->schema([
                    Placeholder::make('Tutorial')
                        ->content(new HtmlString('please visit <a href="https://filamentphp.com/docs/2.x/components/forms/wizard" target="_blank" class="underline">docs</a>')),
                ]),


                Split::make([
                    Section::make('Menus')->description('Prevent abuse by limiting the number of requests per period')->icon('heroicon-m-hand-raised')
                        ->schema([
                            TextInput::make('name')->live(onBlur: true)->required()->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            // TextInput::make('name')->required()->maxLength(255)->afterStateUpdated(function ($state, callable $set) {
                            // //     $set('slug', Str::slug($state));
                            // })->live(),
                            Select::make('parent_id')->relationship('parent', 'name')->preload()->searchable(),
                            Select::make('type')->required()->options([
                                'place' => 'place',
                                'page' => 'page',
                                'list' => 'list',
                                'link' => 'link',
                            ])->placeholder('Default is palce')->live(),

                        ]),
                        Section::make('Menus')->description('Prevent abuse by limiting the number of requests per period')
                                ->schema([
                            Select::make('icon')->options(Iconset::icon())->searchable(),

                            // Hidden::make('slug'),
                            TextInput::make('slug')->label('Route / Link / Slug ')->suffix('.com')->placeholder('jika link maka manual url')
                            ->readOnly(fn (Get $get) => $get('type') !== 'link')
                            ->live(),
                            // TextInput::make('order')->label('Urutan')->integer()->mask('99')
                            //         ->minValue(1)
                            //         ->maxValue(100),
                                ])->grow(false),
                                ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->width('1%'),
                TextColumn::make('name'),
                TextColumn::make('type')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'place' => 'gray',
                    'page' => 'warning',
                    'list' => 'success',
                    'link' => 'danger',
                }),
                TextColumn::make('children.name')->badge()->color('gray')->placeholder('Tidak Ada'),
                // IconColumn::make('icon')->label('Icon')->size('sm')->color('primary')->icon(
                //     fn ($record) => $record->icon ?? 'heroicon-o-rectangle-stack'
                // ),
                ToggleColumn::make('is_active'),
                // IconColumn::make('is_active')->label('Status')->size('sm')->color('primary')->boolean('is_active')->trueIcon('heroicon-o-check-circle')->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }


}

Class Iconset
{
    public static function icon(): array
    {
        $jsonicon = file_get_contents(public_path('frontend/icon.json')); // path
        $files = json_decode($jsonicon, true); // Decode
        if ($files) {
            $icons = [];
            foreach ($files['icons'] as $key => $file) {
                $value = $file['name'] ?? '-';
                $new = Str::ucfirst(str_replace('_', ' ', $value));
                $icons[$value] = $new;

            }
        }

        return $icons;
    }
}
