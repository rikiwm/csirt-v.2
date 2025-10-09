<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TicketChart;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class SummaryReport extends Page
{
    use HasFiltersAction, HasFiltersForm, HasPageShield;

    protected static ?string $navigationGroup = 'Statistik & Laporan';

    protected ?string $heading = 'Ticket Analysis';

    protected ?string $subheading = 'Ticket Analysis';

    protected static ?string $navigationIcon = 'heroicon-m-presentation-chart-line';

    protected static string $view = 'filament.pages.summary-report';

    protected static bool $isLazy = false;
    // protected static bool $shouldRegisterNavigation = true;

    public $selectedYear;

    public function getHeader(): ?View
    {
        return view('filament.header.header', [
            'title' => 'Ticket Report '.$this->selectedYear,
            'subtitle' => 'Rekap laporan Tiket '.$this->selectedYear,
            'background' => null,
        ]);
    }

    public function mount()
    {
        $this->selectedYear = request('selectedYear') ?? now()->year;
        Session::put('selectedYear', $this->selectedYear);
    }

    // Share state ke Widget
    public function updated($propertyName)
    {
        if ($propertyName === 'selectedYear') {
            // Kirim event Livewire ke semua widget yang mendengar 'selectedYear'
            $this->dispatch('selectedYear', $this->selectedYear);
        }
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\WidgetsResource\Widgets\TiketInsident::class,
            TicketChart::class,
        ];
    }
}
