<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ResponTimeAgenWidget;
use App\Filament\Widgets\TicketChart;
use App\Models\Ticket;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;
use App\Models\Type;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View as ComponentsView;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Illuminate\Support\Facades\Session;

class SummaryReport extends Page
{
    use HasPageShield, HasFiltersAction, HasFiltersForm;
    protected ?string $heading = 'Ticket Analysis';
    protected ?string $subheading = 'Ticket Analysis';
    protected static ?string $navigationIcon = 'heroicon-m-presentation-chart-line';
    protected static string $view = 'filament.pages.summary-report';
    protected static bool $isLazy = FALSE;
    // protected static bool $shouldRegisterNavigation = true;

    public $selectedYear;


    public function getHeader(): ?View
    {
        return view('filament.header.header', [
            'title' => 'Ticket Report ' . $this->selectedYear,
            'subtitle' => 'Rekap laporan Tiket ' . $this->selectedYear,
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
            TicketChart::class
        ];
    }
}
