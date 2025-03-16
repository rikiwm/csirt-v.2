<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-m-user-group';
    protected static ?string $navigationGroup = 'Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name'),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->required(),
                Select::make('roles')
                        ->relationship('roles', 'name')->default('user')
                        ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name'),
                TextColumn::make('roles.name')->sortable()->searchable()->badge()->label('Role'),
                TextColumn::make('email')->sortable()->searchable()->icon('heroicon-m-envelope-open')->copyable()->copyMessage(' email copied'),
                TextColumn::make('email_verified_at')->date()->dateTimeTooltip()->icon('heroicon-m-check-circle')->color('success'),
                TextColumn::make('created_at')->date()->dateTimeTooltip(),
                TextColumn::make('updated_at')->since()->dateTimeTooltip(),

            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\EditAction::make()->label(false),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


}
