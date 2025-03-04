<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriResource\Pages;
use App\Filament\Resources\CategoriResource\RelationManagers;
use App\Models\Categori;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriResource extends Resource
{
    protected static ?string $model = Categori::class;
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationIcon = 'heroicon-m-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->live(onBlur: true)->required()->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')->label('Route / Link / Slug ')->suffix('.com')->placeholder('jika link maka manual url'),
                Textarea::make('description')->label('Deskripsi')->placeholder('Deskripsi kategori')->columnSpanFull(),
                Select::make('parent_id')->relationship('parent', 'name')->preload()->searchable(),
                Hidden::make('created_by')->default(auth()->id()),
                Radio::make('is_active')
                    ->label('Active?')->inline()->default('1')
                    ->inlineLabel(false)
                    ->boolean(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name'),
                TextColumn::make('created_at')
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
            'index' => Pages\ListCategoris::route('/'),
            'create' => Pages\CreateCategori::route('/create'),
            'edit' => Pages\EditCategori::route('/{record}/edit'),
        ];
    }
}
