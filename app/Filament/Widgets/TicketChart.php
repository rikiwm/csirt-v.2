<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Builder;


class TicketChart extends ChartWidget
{
    use HasWidgetShield, InteractsWithPageFilters;
    protected static ?string $heading = 'Insiden Summary';
    protected static ?string $maxHeight = '200px';
    public ?string $filter = 'today';
    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $ticketCounts = DB::table('tickets')
        ->selectRaw('
            MONTH(created_at) as month,
            SUM(CASE WHEN status = "open" THEN 1 ELSE 0 END) as open_count,
            SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) as closed_count
        ')
        ->when($startDate, fn ($query) => $query->whereDate('created_at', '>=', $startDate))
        ->when($endDate, fn ($query) => $query->whereDate('created_at', '<=', $endDate))
        ->when(
            !auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen'),
            fn ($query) => $query->where('users_id', auth()->id())
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->keyBy('month');

        $dataOpen = [];
        $dataClosed = [];

        for ($i = 1; $i <= 12; $i++) {
            $dataOpen[] = $ticketCounts[$i]->open_count ?? 0;
            $dataClosed[] = $ticketCounts[$i]->closed_count ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tickets Created',
                    'data' => $dataOpen,
                    'borderWidth' => 2,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                ],
                [
                    'label' => 'Tickets Closed',
                    'data' => $dataClosed,
                    'borderWidth' => 2,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    public function getDescription(): ?string
    {
        return 'The number of blog posts published per month.';
    }
}
