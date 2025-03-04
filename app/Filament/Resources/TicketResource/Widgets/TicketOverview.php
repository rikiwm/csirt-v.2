<?php

namespace App\Filament\Resources\TicketResource\Widgets;

use App\Filament\Resources\TicketResource;
use App\Filament\Resources\TicketResource\Pages\ListTickets;
use App\Models\Ticket;
use Filament\Forms\Components\Builder;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketOverview extends BaseWidget
{

    use InteractsWithPageFilters;
    protected static ?string $pollingInterval = '50s';
    protected ?string $description = 'An overview of some Ticket.';



    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        return [
            Stat::make('Open',TicketResource::getEloquentQuery()
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->where('status', 'open')->count())
            ->chart([7, 6, 5, 4, 2, 1])
            ->label(false)
            ->color('primary')
            ->description('Open ')
            ->descriptionIcon('heroicon-m-lock-open'),
            Stat::make('Closed', TicketResource::getEloquentQuery()->where('status', 'closed')->count())
            ->chart([0, 0, 0, 1, 0, 0, 0])
            ->label(false)
            ->color('primary')
            ->description('Closed ')
            ->descriptionIcon('heroicon-m-lock-closed'),
            Stat::make('Progress', TicketResource::getEloquentQuery()->where('status', 'in-progress')->count())
            ->label(false)
            ->color('primary')
            ->description('In Progress ')
            ->chart([1, 2, 3, 4, 5, 6, 7])
            ->descriptionIcon('heroicon-m-clock'),
        ];
    }


}
