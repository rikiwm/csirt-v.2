<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketAttachmentResource\Pages;
use App\Filament\Resources\TicketAttachmentResource\RelationManagers;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketAttachmentResource extends Resource
{
    protected static ?string $model = TicketAttachment::class;
   protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            //     Select::make('ticket_id')->options(Ticket::where('is_verified', 1)
            //             ->where('is_duplicate', 0)
            //             ->where('status', 'closed')
            //             ->pluck('subject', 'id')
            //     )
            //     ->required(),
            //     Hidden::make('user_id')->default(auth()->user()->id),
            //    SpatieMediaLibraryFileUpload::make('ticket_reward')->collection('ticket_reward')->disk('public')->label('Dokument')
            //     ->rules(['mimetypes:image/jpeg,image/png,application/pdf'])
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
            'index' => Pages\ListTicketAttachments::route('/'),
            'create' => Pages\CreateTicketAttachment::route('/create'),
            'edit' => Pages\EditTicketAttachment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
