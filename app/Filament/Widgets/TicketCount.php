<?php

namespace App\Filament\Widgets;

// use App\Filament\Resources\TicketResource;

use App\Models\Ticket;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class TicketCount extends BaseWidget
{
    use InteractsWithPageFilters;



    protected function getStats(): array
    {
        $queri = Ticket::query();
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        // $year = $this->filters['year'] ?? null;
        return [
            Stat::make(
                label: 'Total posts',
                value:$queri
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->where(function($queri){
            if (!auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen')) {
                    return $queri->where('users_id', auth()->id());
                }
            })
            ->where('status', 'open')->count())
            ->chart([7, 6, 5, 4, 2, 1])
            ->label(false)
            ->color('primary')
            ->description('Open ') ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ])
            ->descriptionIcon('heroicon-m-lock-open'),
            Stat::make('Closed', $queri
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->where(function($queri){
            if (!auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen')) {
                    return $queri->where('users_id', auth()->id());
                }
            })
            ->where('status', 'closed')->count())
            ->chart([0, 0, 0, 1, 0, 0, 0])
            ->label(false)
            ->color('primary')
            ->description('Closed ')
            ->descriptionIcon('heroicon-m-lock-closed'),
            Stat::make('Progress', $queri
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->where(function($queri){
            if (!auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen')) {
                    return $queri->where('users_id', auth()->id());
                }
            })
            ->where('status', 'in-progress')->count())
            ->label(false)
            ->color('primary')
            ->description('In Progress '.$startDate. '-' . $endDate)
            ->chart([1, 2, 3, 4, 5, 6, 7])
            ->descriptionIcon('heroicon-m-clock'),
        ];
    }

    // kondisi role
    // public static function canView(): bool
    // {
    //     return auth()->user()->isAdmin();
    // }
}
