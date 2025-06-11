<?php

namespace App\Livewire;

use App\Models\Ticket;
use App\Models\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
class SummaryReports extends Component implements HasForms, HasTable
{
     use InteractsWithForms;
     use InteractsWithTable;
     protected static bool $isLazy = false;

     protected ?string $heading = 'Response Time Insidenr';
     protected ?string $description = 'An overview of some analytics.';

    public function table(Table $table): Table
    {
        return $table
            ->query(Ticket::query()->select('id','code','subject','users_id','agent_id','created_at','status','priority')->with(['users', 'useragen', 'types'])
            ->when(!auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen'), function ($query) {
                $query->where('users_id', auth()->id());
            }))
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('users.name')->label('Nama')->sortable()->searchable(),
                TextColumn::make('useragen.name')->label('Agent')->searchable(),
                TextColumn::make('subject')->limit(50),
                TextColumn::make('types.name')->limit(50)->badge()->color('primary'),
                TextColumn::make('priority')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'low' => 'secondary',
                    'medium' => 'info',
                    'high' => 'warning',
                    'urgent' => 'danger',
                }),
                TextColumn::make('status')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'open' => 'secondary',
                    'in_progress' => 'warning',
                    'closed' => 'success',
                }),
                TextColumn::make('created_at')->date(),
                TextColumn::make('response_time')->label('Response Time')
                ->getStateUsing(fn ($record): ?string => $this->avgresponsetime($record->id)),
            ])
            // ->filters([

            // ])
            ->filters([
                SelectFilter::make('status')
                ->multiple()->options([
                    'open' => 'Open',
                    'in_progress' => 'In Progress',
                    'closed' => 'Closed',
                ])
                ->default('draft')
                ->selectablePlaceholder(false),
                SelectFilter::make('priority')->multiple()->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                    'urgent' => 'Urgent',
                ])
                ->selectablePlaceholder(false),
                SelectFilter::make('types.name')
                ->relationship('types', 'name')->searchable()
                ->label('Insident')->options(
                    fn() => Type::query()->pluck('name','id'))
                    ->multiple()
                    ->selectablePlaceholder(false),
                Filter::make('created_at')
                        ->form([
                                DatePicker::make('from'),
                                DatePicker::make('until'),

                        ])
                        ->indicateUsing(function (array $data): array {
                            $indicators = [];
                            if ($data['from'] ?? null) {
                                $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['from'])->toFormattedDateString())
                                    ->removeField('from');
                            }

                            if ($data['until'] ?? null) {
                                $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['until'])->toFormattedDateString())
                                    ->removeField('until');
                            }

                            return $indicators;
                        })->columns(2),


            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersFormWidth(MaxWidth::FourExtraLarge)
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()->color('primary')
                    ->label('Filter Data'),
            )->deselectAllRecordsWhenFiltered(false)
            ->actions([
                // ...
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('Export')
                    ->label('Export To PDF')
                        ->icon('heroicon-m-arrow-down-tray')
                        ->openUrlInNewTab()
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $tickets) {
                            return response()->streamDownload(function () use ($tickets) {
                                echo Pdf::loadHTML(
                                    Blade::render('filament.pages.ticket.ticket-print',compact('tickets'))
                                )->stream();
                            }, 'users.pdf');
                        }),
                ]),
            ]);
    }

    public function avgresponsetime($ticketId= null)
    {
        $averageResponseTime = Ticket::where('status', 'closed')
            ->where('tickets.id', $ticketId)
            ->join('ticket_massages as first_message', function ($join) {
                $join->on('tickets.id', '=', 'first_message.ticket_id')
                    ->whereRaw('first_message.id = (
                    SELECT MIN(id)
                    FROM ticket_massages
                    WHERE ticket_massages.ticket_id = tickets.id
                    )');
            })
            ->join('ticket_massages as first_reply', function ($join) {
                $join->on('tickets.id', '=', 'first_reply.ticket_id')
                    ->whereRaw('first_reply.id = (
                        SELECT MIN(id) FROM ticket_massages
                        WHERE ticket_massages.ticket_id = tickets.id
                        AND ticket_massages.user_id != first_message.user_id
                    )');
            })
            ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, first_message.created_at, first_reply.created_at)) as avg_response_time'))
            ->value('avg_response_time');

        if ($averageResponseTime === null) {
            return 'N/A';
        }
        return gmdate("i:s", $averageResponseTime);
    }
    public function filter(BaseFilter $filter)
        {
            return $filter;
    }
    public function render()
    {
        try {
            $avg = $this->avgClosed();

        } catch (\Exception $e) {
            $avg = 'Kosong';
        }

        $tickets = Ticket::query()->select('id', 'status', 'is_verified')->get();

        $total = $tickets->count();
        $closed = $tickets->where('status', 'closed')->count();
        $open = $tickets->where('status', 'open')->count();
        $valid = $tickets->where('is_verified', true)->count();
        $invalid = $tickets->where('is_verified', false)->count();

        return view('livewire.summary-reports', compact('avg', 'total','closed','open','valid','invalid'));
    }

    private function avgClosed($ticketId= null)
    {
        $averageResponseTime = Ticket::where('status', 'closed')
            ->join('ticket_massages as first_message', function ($join) {
                $year = Carbon::now()->format('Y') ?? date('Y');
                $join->on('tickets.id', '=', 'first_message.ticket_id')
                    ->whereRaw('first_message.id = (
                    SELECT MIN(id)
                    FROM ticket_massages
                    WHERE ticket_massages.ticket_id = tickets.id
                    OR YEAR(first_message.created_at) = ' . $year . '
                    )');
            })
            ->join('ticket_massages as first_reply', function ($join) {
                $year = Carbon::now()->format('Y') ?? date('Y');
                $join->on('tickets.id', '=', 'first_reply.ticket_id')
                    ->whereRaw('first_reply.id = (
                        SELECT MIN(id) FROM ticket_massages
                        WHERE ticket_massages.ticket_id = tickets.id
                        AND ticket_massages.user_id != first_message.user_id

                    )');
            })
            ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, first_message.created_at, first_reply.created_at)) as avg_response_time'))
            ->value('avg_response_time');
// dd($averageResponseTime->toSql(), $averageResponseTime->getBindings());
        if ($averageResponseTime === null) {
            return 'N/A';
        }
        return gmdate("i:s", $averageResponseTime);
    }
}
