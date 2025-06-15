<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ResponTimeAgenWidget;
use App\Filament\Widgets\TicketChart;
use App\Models\Ticket;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;
use App\Models\Type;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use App\Filament\Resources\WidgetsResource\Widgets\TiketInsident;


class SummaryReport extends Page
{
    use HasPageShield, HasFiltersAction, HasFiltersForm;
    protected ?string $heading = 'Ticket Analysis';
    protected ?string $subheading = 'Ticket Analysis';
    protected static ?string $navigationIcon = 'heroicon-m-presentation-chart-line';
    protected static string $view = 'filament.pages.summary-report';
    protected static bool $isLazy = true;
    public ?string $startDate = '';
    public ?string $endDate = '';

    public function getHeaderActions(): array
    {
        return [
            Action::make('ExportPDF')
                ->label('Export All to PDF')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(route('summary-report.print', [
                    'startDate' => $this->startDate,
                    'endDate' => $this->endDate
                ]), shouldOpenInNewTab: true),
            // FilterAction::make('filter')
            //     ->icon('heroicon-o-calendar')
            //     ->form([
            //         DatePicker::make('startDate')
            //         ->prefix('Star')
            //         ->suffixActions([
            //             ActionsAction::make('reset')->icon('heroicon-o-trash')
            //             ->action(fn (callable $set) => $set('startDate', null)),
            //         ])
            //         ->native(true)
            //         ->afterStateUpdated(fn ($state, callable $set) => $set('endDate', $state))->live(onBlur:true),

            //     DatePicker::make('endDate')
            //         ->prefix('End')
            //         ->suffixActions([
            //             ActionsAction::make('reset')->icon('heroicon-o-trash')
            //             ->action(fn (callable $set) => $set('endDate', null)),
            //         ])
            //         ->native(false)->default(null)
            //         ->minDate(fn ($get) => $get('startDate')),
            //     Select::make('type_id')->label('insiden')
            //         ->options(fn () => Type::pluck('name', 'id'))
            //         ->preload()
            //         ->suffixActions([
            //             ActionsAction::make('reset')->icon('heroicon-o-trash')
            //             ->action(fn (callable $set) => $set('type_id', null)),
            //         ])
            //         ->searchable(),
            //     Select::make('priority')->multiple()->options([
            //         'low' => 'Low',
            //         'medium' => 'Medium',
            //         'high' => 'High',
            //         'urgent' => 'Urgent',
            //     ])->suffixActions([
            //         ActionsAction::make('reset')->icon('heroicon-o-trash')
            //         ->action(fn (callable $set) => $set('priority', null)),
            //     ]),
            // ])->color('primary')
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
