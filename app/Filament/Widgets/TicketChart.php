<?php

namespace App\Filament\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TicketChart extends ChartWidget
{
    use HasWidgetShield;
    protected static ?string $heading = 'Insiden Analytic';

    protected function getData(): array
    {
        $ticketCounts = DB::table('tickets')
                            ->selectRaw('MONTH(created_at) as month, COUNT(id) as count')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->where('status','open')
                            ->pluck('count', 'month')
                            ->toArray();
        // $open = $ticketCounts['status'] == 'open';
        // $x = $ticketCounts['status'] == 'closed';
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $ticketCounts[$i] ?? 0;
        }
        return [
            'datasets' => [
                [   'label' => 'Tickets Created',
                     'data' => [$data],[$data],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],


        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function getDescription(): ?string
    {
        return 'The number of blog posts published per month.';
    }
}
