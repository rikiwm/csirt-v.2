<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketMassageResource\Pages;
use App\Filament\Resources\TicketMassageResource\RelationManagers;
use App\Models\TicketMassage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TicketMassageResource extends Resource
{
    protected static ?string $model = TicketMassage::class;
    protected static ?string $navigationIcon = 'heroicon-m-chat-bubble-left-right';
    // protected static ?string $navigationGroup = 'Ticket';
    protected static bool $shouldRegisterNavigation = false;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListTicketMassages::route('/'),
            'create' => Pages\CreateTicketMassage::route('/create'),
            'edit' => Pages\EditTicketMassage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
            ]);
    }
}
