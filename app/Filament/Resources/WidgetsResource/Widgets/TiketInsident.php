<?php

namespace App\Filament\Resources\WidgetsResource\Widgets;


use Illuminate\Support\Facades\DB;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Forms\Components\Builder;
class TiketInsident extends ChartWidget
{
    use HasWidgetShield;
    protected static ?string $heading = 'Bagan Laporan Insiden Berdasarkan Prioritas';
    protected static ?string $maxHeight = '300px';
    use InteractsWithPageFilters;
    protected function getData(): array
    {
           $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $ticketCounts = DB::table('tickets')
            ->selectRaw('
                MONTH(created_at) as month,
                SUM(CASE WHEN priority = "low" THEN 1 ELSE 0 END) as low,
                SUM(CASE WHEN priority = "medium" THEN 1 ELSE 0 END) as medium,
                SUM(CASE WHEN priority = "high" THEN 1 ELSE 0 END) as high,
                SUM(CASE WHEN priority = "urgent" THEN 1 ELSE 0 END) as urgent
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

        $labels = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec',
        ];

        $lowData = [];
        $mediumData = [];
        $highData = [];
        $urgentData = [];

        foreach ($labels as $month => $label) {
            $lowData[] = $ticketCounts[$month]->low ?? 0;
            $mediumData[] = $ticketCounts[$month]->medium ?? 0;
            $highData[] = $ticketCounts[$month]->high ?? 0;
            $urgentData[] = $ticketCounts[$month]->urgent ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Low',
                    'data' => $lowData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.5)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Medium',
                    'data' => $mediumData,
                    'backgroundColor' => 'rgba(255, 205, 86, 0.5)',
                    'borderColor' => 'rgba(255, 205, 86, 1)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'High',
                    'data' => $highData,
                    'backgroundColor' => 'rgba(255, 159, 64, 0.5)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Urgent',
                    'data' => $urgentData,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => array_values($labels),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

  public function getDescription(): ?string
    {
        return 'The number of tickets created per month, categorized by priority.';
    }
}
