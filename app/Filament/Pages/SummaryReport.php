<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ResponTimeAgenWidget;
use App\Filament\Widgets\TicketChart;
use App\Models\Ticket;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;

class SummaryReport extends Page
{
    use HasPageShield, HasFiltersAction;
    protected static string $view = 'filament.pages.summary-report';
    protected ?string $heading = 'Ticket Analysis';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected function getHeaderActions(): array
    {
        return [
         FilterAction::make('filters')
                ->form([
                    DatePicker::make('startDate'),
                    DatePicker::make('endDate'),
               
                ]),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
                \App\Filament\Resources\WidgetsResource\Widgets\TiketInsident::class,
                TicketChart::class,
        ];
    }







}
