<?php

namespace App\Filament\Widgets;

// use App\Filament\Resources\TicketResource;

use App\Models\Ticket;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TicketCount extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        // Query dasar untuk Ticket
        $baseQuery = Ticket::query()
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->when(
                !auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen'),
                fn (Builder $query) => $query->where('users_id', auth()->id())
            );
       // Ambil data statistik berdasarkan minggu
            $ticketCounts = DB::table('tickets')
                ->selectRaw('
                    WEEK(created_at) as week,
                    SUM(CASE WHEN status = "open" THEN 1 ELSE 0 END) as open_count,
                    SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed_count
                ')
                ->when($startDate, fn ($query) => $query->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn ($query) => $query->whereDate('created_at', '<=', $endDate))
                ->when(
                    !auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen'),
                    fn ($query) => $query->where('users_id', auth()->id())
                )
                ->groupBy('week')
                ->orderBy('week')
                ->get()
                ->keyBy('week');

            // Siapkan array data chart untuk 12 minggu terakhir
            $dataOpen = [];
            $dataClosed = [];

            for ($i = 1; $i <= 7; $i++) {
                $dataOpen[] = $ticketCounts[$i]->open_count ?? 0;
                $dataClosed[] = $ticketCounts[$i]->closed_count ?? 0;
            }


        return [
            Stat::make('Open', (clone $baseQuery)->where('status', 'open')->count())
                ->chart($dataOpen)
                ->label(false)
                ->color('primary')
                ->description('Open')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ])
                ->descriptionIcon('heroicon-m-lock-open'),

            Stat::make('Closed', (clone $baseQuery)->where('status', 'closed')->count())
                ->chart($dataClosed)
                ->label(false)
                ->color('primary')
                ->description('Closed')
                ->descriptionIcon('heroicon-m-lock-closed'),

            Stat::make('Progress', (clone $baseQuery)->where('status', 'in_progress')->count())
                ->chart([1, 2, 3, 4, 5, 6, 7])
                ->label(false)
                ->color('primary')
                ->description('In Progress')
                ->descriptionIcon('heroicon-m-clock'),
        ];
    }


}
