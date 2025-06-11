<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\Components\Builder;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class TicketChartLine extends ChartWidget
{
    use HasWidgetShield, InteractsWithPageFilters;
    protected static ?string $heading = 'Bagan Laporan Insiden oleh Terverifikasi dan Tidak Terverifikasi';
    protected static ?string $maxHeight = '300px';
    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $ticketCounts = DB::table('tickets')
        ->selectRaw('
            MONTH(created_at) as month,
            SUM(CASE WHEN is_verified = "1" THEN 1 ELSE 0 END) as verified_count,
            SUM(CASE WHEN is_verified = "0" THEN 1 ELSE 0 END) as not_verified_count
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
            $dataOpen[] = $ticketCounts[$i]->verified_count ?? 0;
            $dataClosed[] = $ticketCounts[$i]->not_verified_count ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tickets Verified',
                    'data' => $dataOpen,
                    'borderWidth' => 2,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                ],
                [
                    'label' => 'Tickets Not Verified',
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
        return 'line';
    }
    public function getDescription(): ?string
    {
        return 'The number of blog posts published per month.';
    }

    public function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Tickets',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Month',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
            'tension' => 0.4, // Adjust the tension for smooth lines
            'elements' => [
                'line' => [
                    'borderWidth' => 2,
                    'borderColor' => 'rgba(54, 162, 235, 1)', // Default line color
                    'fill' => false, // Fill the area under the line
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => true,
        ];
    }
}
