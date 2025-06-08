<?php

namespace App\Filament\Widgets\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TabelTopUser extends BaseWidget
{
    protected static ?string $maxHeight = '400px';

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\User::query()
                ->withCount(['tickets as open_tickets_count' => function ($query) {
                    $query->where('status', 'open');
                }])
                ->withCount(['tickets as closed_tickets_count' => function ($query) {
                    $query->where('status', 'closed');
                }])
                ->orderBy('open_tickets_count', 'desc')
            )
            ->defaultSort('open_tickets_count', 'desc')
            ->emptyStateHeading('No Users Found')
            ->emptyStateDescription('There are no users to display.')
            ->emptyStateIcon('heroicon-o-user-group')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(false),
                Tables\Columns\TextColumn::make('email')
                    ->label(false),
                Tables\Columns\TextColumn::make('open_tickets_count')
                    ->label('Open Tickets'),
                Tables\Columns\TextColumn::make('closed_tickets_count')
                    ->label('Closed Tickets'),
            ]);
    }
}
