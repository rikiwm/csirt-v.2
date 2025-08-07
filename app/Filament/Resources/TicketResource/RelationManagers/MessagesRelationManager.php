<?php

namespace App\Filament\Resources\TicketResource\RelationManagers;

use App\Models\TicketMassage;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MessagesRelationManager extends RelationManager
{

    protected static string $relationship = 'messages';

    public function view(ViewRecord $page): ViewRecord
    {
        return $page
            ->schema([
                Textarea::make('message')
                    ->required()
                    ->maxLength(255),
                Hidden::make('user_id')->default(auth()->id()),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sender.name')->label('Pengirim')->sortable(),
                TextColumn::make('message')->label('Pesan')->limit(50),
                TextColumn::make('created_at')->label('Dikirim')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


}
