<?php

namespace App\Filament\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TicketChartLine extends ChartWidget
{
    use HasWidgetShield;
    protected static ?string $heading = 'Insiden Analytic';
    protected function getData(): array
    {
        $ticketCounts = DB::table('tickets')
        ->selectRaw('MONTH(created_at) as month, COUNT(id) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month')
        ->toArray();
    // array data  bulan
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $ticketCounts[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tickets Created',
                    'data' => $data,
                    'borderWidth' => 2,
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
}
