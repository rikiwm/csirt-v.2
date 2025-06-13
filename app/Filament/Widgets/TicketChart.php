<?php

namespace App\Filament\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class TicketChart extends ChartWidget
{
    use HasWidgetShield, InteractsWithPageFilters;
    protected static ?string $heading = 'Bagan Laporan Insiden Tiket Terbuka dan Tiket Tertutup';
    protected static ?string $maxHeight = '300px';
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
                    'label' => 'Tickets Open',
                    'axis' => 'y',
                    'data' => $dataOpen,
                    'borderWidth' => 1,
                    'backgroundColor' => 'rgb(206, 206, 206)',
                    'borderColor' => 'rgb(255, 255, 255)',
                ],
                [
                    'label' => 'Tickets Closed',
                    'axis' => 'y',
                    'data' => $dataClosed,
                    'borderWidth' => 1,
                    'backgroundColor' => 'rgb(39, 39, 39)',
                    'borderColor' => 'rgb(255, 255, 255)',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    // protected function getFilters(): ?array
    // {
    //     return [
    //         'today' => 'startDate',
    //         'week' => 'endDate',
    //         'month' => 'Last month',
    //         'year' => 'This year',
    //     ];
    // }

    public function getDescription(): ?string
    {
        return 'The number of blog posts published per month.';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                ],
                'title' => [
                    'display' => false,
                    'text' => 'Tickets Opened and Closed',
                ],
            ],
            'responsive' => true,
            'indexAxis' => 'y', // Use 'y' for horizontal bar chart
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Month of Tickets',
                    ],
                ],
            ],
            'elements' => [
                'bar' => [
                    'borderWidth' => 1,
                    'borderRadius' => 15, // Add border radius for rounded corners
                ],
            ],
            'barPercentage' => 1, // Adjust bar width
            'categoryPercentage' => 1, // Adjust category width
        ];
    }
}
