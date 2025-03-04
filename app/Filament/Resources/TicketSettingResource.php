<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketSettingResource\Pages;
use App\Filament\Resources\TicketSettingResource\RelationManagers;
use App\Models\TicketSetting;
use Filament\Forms;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketSettingResource extends Resource
{
    protected static ?string $model = TicketSetting::class;

    protected static ?string $navigationIcon = 'heroicon-m-cog-8-tooth';
    protected static ?string $navigationGroup = 'Ticket';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Setup')->schema([
                    TextInput::make('key')->required()->label('Title')->placeholder('title'),
                    ComponentsBuilder::make('value')
                    ->blocks([
                        Block::make('heading')
                            ->schema([
                                TextInput::make('content')
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
                                    ])
                                    ->required(),
                            ])
                            ->columns(2),
                        Block::make('paragraph')
                            ->schema([
                                Textarea::make('content')
                                    ->label('Paragraph')
                                    ->required(),
                            ]),
                        Block::make('key')->label('like json')
                            ->schema([
                                TextInput::make('keys')
                                ->label('Keys')
                                ->required(),
                                TextInput::make('content')
                                ->label('Body')
                                ->required(),
                            ])->columns(2),
                        // Block::make('image')
                        //     ->schema([
                        //         FileUpload::make('url')
                        //             ->label('Image')
                        //             ->image()
                        //             ->required(),
                        //         TextInput::make('alt')
                        //             ->label('Alt text')
                        //             ->required(),
                        //     ]),
                    ])->columnSpanFull(),
                    // KeyValue::make('value')->reorderable()->keyLabel('Key')->valueLabel('Body')->columnSpanFull(),
                    //
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('Title')->sortable()->searchable(),
                //
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListTicketSettings::route('/'),
            'create' => Pages\CreateTicketSetting::route('/create'),
            'edit' => Pages\EditTicketSetting::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
            ]);
    }
}
