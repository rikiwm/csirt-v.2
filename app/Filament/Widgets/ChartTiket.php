<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Ticket;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class ChartTiket extends ChartWidget
{

    use HasWidgetShield, InteractsWithPageFilters;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {

        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $data = Trend::model(Ticket::class)
            ->between(
                start: $startDate ? Carbon::parse($startDate) : now()->startOfYear(),
                end: $endDate ? Carbon::parse($endDate) : now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Total Insiden',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
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

            ],
            'minBarLength' => 2, // Minimum bar length
            'barStart' => 0, // Start bar from 0
            'responsive' => true,
            'indexAxis' => 'x', // Use 'y' for horizontal bar chart
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Tickets',
                    ],
                ],
            ],
            'elements' => [
                'bar' => [
                    'borderWidth' => 1,
                    'borderRadius' => 8, // Add border radius for rounded corners
                ],
            ],
            'barPercentage' => 0.4, // Adjust bar width
            'categoryPercentage' => 0.8, // Adjust category width
        ];
    }
    public function getDescription(): ?string
    {
        return 'Bagan Laporan Insiden Tahunan';
    }
}