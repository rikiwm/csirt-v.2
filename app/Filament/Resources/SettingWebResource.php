<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingWebResource\Pages;
use App\Filament\Resources\SettingWebResource\RelationManagers;
use App\Models\SettingWeb;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Get;
use Filament\Forms\HtmlString;
class SettingWebResource extends Resource
{
    protected static ?string $model = SettingWeb::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Setup')->columns(1)->aside()->description(fn (Get $get) => match ($get('key')) {
                'hero-section' => 'Hero Section',
                'section-1' => 'Section 1',
                'section-2' => 'Section 2',
                'section-3' => 'Section 3',
                'section-4' => 'Section 4',
            })->schema([
                  Fieldset::make('Setup')->schema([
                 Select::make('key')->label('key')
                   ->options(function ($get) {
                    $usedKeys = SettingWeb::pluck('key')->toArray();
                    $allOptions = [
                        'hero-section' => 'Hero',
                        'section-1' => 'Section 1',
                        'section-2' => 'Section 2',
                        'section-3' => 'Section 3',
                        // 'section-4' => 'Section 4',
                        // 'section-5' => 'Section 5',
                        // 'section-6' => 'Section 6',
                        // 'team-section' => 'Team',
                        // 'welcome' => 'View welcome',
                        // 'app' => 'App name',
                        // 'copyright' => 'Copyright',
                        // 'footer' => 'Footer',
                        // 'contact' => 'Contact',
                        // 'social' => 'Social',
                        // 'address' => 'Address',
                        // 'phone' => 'Phone',
                        // 'email' => 'Email',
                    ];
                    $currentKey = $get('key');
                    if ($currentKey && !in_array($currentKey, $usedKeys)) {
                        // aman, tidak perlu ubah
                    } elseif ($currentKey && in_array($currentKey, $usedKeys)) {
                        // hapus dari usedKeys agar tetap tampil
                        $usedKeys = array_diff($usedKeys, [$currentKey]);
                    }
                    return collect($allOptions)
                        ->reject(fn ($label, $key) => in_array($key, $usedKeys))
                        ->toArray();
                })
                ->selectablePlaceholder($currentKey ?? 'Select a view')
                ->disabled(fn ($record) => filled($record))
                ->required(),
                ToggleButtons::make('status')->boolean()->label('Is Active')->inline(),
                ComponentsBuilder::make('value')
                    ->blocks([
                        Block::make('view')
                        ->schema([
                            TextInput::make('section-view')
                                ->label('Section View')
                                ->required(),
                            Select::make('model-view')
                                ->label('Model View')
                                ->options([
                                    'berita' => 'View Berita',
                                    'peringatan' => 'View Peringatan',
                                    'data' => 'View Data',
                                ])
                                ->required(),
                        ])
                        ->columns(2),
                        Block::make('heading')
                            ->schema([
                                TextInput::make('content')
                                    ->label('Title')
                                    ->required(),
                                TextInput::make('sub_content')
                                    ->label('Deskripsi')
                                    ->required(),
                            ])
                            ->columns(2),
                        Block::make('paragraph')
                            ->schema([
                                Textarea::make('content')
                                    ->label('Paragraph')
                                    ->required(),
                            ]),
                        Block::make('key')->label('like json array')
                            ->schema([
                                TextInput::make('keys')
                                ->label('Keys')
                                ->required(),
                                TextInput::make('content')
                                ->label('Body')
                                ->required(),
                            ])->columns(2),
                            Block::make('desc')->label('Description')
                            ->schema([
                                TextInput::make('desc')
                                ->label('desc')
                                ->required(),
                            ])->columns(1),

                    ])->columnSpanFull(),
            ])
            ])


        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('Title')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSettingWebs::route('/'),
            'create' => Pages\CreateSettingWeb::route('/create'),
            'edit' => Pages\EditSettingWeb::route('/{record}/edit'),
        ];
    }
}
