<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ResponTimeAgenWidget;
use App\Filament\Widgets\TicketChart;
use App\Models\Ticket;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;


class SummaryReport extends Page
{
    use HasPageShield;
    protected static string $view = 'filament.pages.summary-report';
    protected ?string $heading = 'Ticket Analysis';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected function getHeaderActions(): array
    {
        return [
            Action::make('Print')
                ->label('Export All to PDF')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url('/app/summary-report/print',shouldOpenInNewTab: true)
                // ->action(function () {
                //     $url = url('/summary-report/print');
                //     return "<script>window.open('$url', '_blank');</script>";
                // }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
                \App\Filament\Resources\WidgetsResource\Widgets\TiketInsident::class,
                TicketChart::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            // TicketCount::class
        ];
    }





}
