<?php

namespace App\Livewire;

use App\Models\Ticket;
use App\Models\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class SummaryReports extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithPageFilters;
    use InteractsWithTable;

    protected static bool $isLazy = false;

    protected ?string $heading = 'Response Time Insidenr';

    protected ?string $description = 'An overview of some analytics.';

    public $type;

    public $insiden;

    public $total;

    public $closed;

    public $open;

    public $valid;

    public $invalid;

    public $avg;

    public $selectedYear;

    public function mount()
    {
        $this->insiden = Type::pluck('name', 'id');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Ticket::query()->select('id', 'code', 'subject', 'users_id', 'agent_id', 'created_at', 'status', 'priority')->with(['users', 'useragen', 'types'])
                ->when(! auth()->user()->hasRole('super_admin') && ! auth()->user()->hasRole('agen'), function ($query) {
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
                        fn () => Type::query()->pluck('name', 'id')
                    )
                    ->multiple()
                    ->selectablePlaceholder(false),
                //   Filter::make('created_at_range')
                //     ->form([
                //         DatePicker::make('created_from')->label('Dari Tanggal'),
                //         DatePicker::make('created_until')->label('Sampai Tanggal'),
                //     ])
                //     ->query(function (Builder $query, array $data): Builder {
                //         return $query
                //             ->when($data['created_from'], fn ($q) => $q->whereDate('created_at', '>=', $data['created_from']))
                //             ->when($data['created_until'], fn ($q) => $q->whereDate('created_at', '<=', $data['created_until']));
                //     })
                //     ->label('Filter Tanggal'),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),

                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('created_at', '<=', $data['until']));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators[] = Indicator::make('Created from '.Carbon::parse($data['from'])->toFormattedDateString())
                                ->removeField('from');
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = Indicator::make('Created until '.Carbon::parse($data['until'])->toFormattedDateString())
                                ->removeField('until');
                        }

                        return $indicators;
                    })->columns(2),

            ], layout: FiltersLayout::Modal)
            ->filtersFormWidth(MaxWidth::FourExtraLarge)
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()->color('primary')
                    ->label('Filter Data'),
            )->deselectAllRecordsWhenFiltered(false)
            ->headerActions([
                Action::make('Export Excel')->size(ActionSize::ExtraSmall)->outlined()
                    ->label('Export to Excel')
                    ->icon('heroicon-o-arrow-down-on-square')
                    ->action('exportExcel'),

                Action::make('Export PDF')->size(ActionSize::ExtraSmall)->outlined()
                    ->label('Export to PDF')
                    ->icon('heroicon-o-document')
                    ->action('exportPdf')->url(fn () => route('summary-report.print', [
                        'selectedYear' => $this->selectedYear,
                    ]))->openUrlInNewTab(),
            ])
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
                                    Blade::render('filament.pages.ticket.ticket-print', compact('tickets'))
                                )->stream();
                            }, 'users.pdf');
                        }),
                ]),
            ]);
    }

    public function avgresponsetime($ticketId = null)
    {
        $year = $this->selectedYear ?? now()->year;

        $averageResponseTime = Ticket::where('status', 'closed')
            ->where('tickets.id', $ticketId)
            // ->when($year, fn($query) => $query->whereYear('created_at',  $year))
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

        return gmdate('i:s', $averageResponseTime);
    }

    public function filter(BaseFilter $filter)
    {
        return $filter;
    }

    public function render()
    {
        $year = $this->selectedYear ?? now()->year;

        try {
            $avg = $this->avgClosed();
        } catch (\Exception $e) {
            $avg = 'Kosong';
        }

        $tickets = Ticket::query()->with('types')->when($year, fn ($query) => $query->whereYear('created_at', $year));

        $this->closed = (clone $tickets)->where('status', 'closed')->count();
        $this->open = (clone $tickets)->where('status', 'open')->count();
        $this->valid = (clone $tickets)->where('is_verified', true)->count();
        $this->invalid = (clone $tickets)->where('is_verified', false)->count();
        if ($this->type) {
            $this->total = (clone $tickets)
                ->whereHas('types', function ($query) {
                    $query->whereIn('type_id', (array) $this->type);
                })
                ->count();
        } else {
            $this->total = (clone $tickets)->count();
        }

        return view('livewire.summary-reports');
    }

    #[On('selectedYear')]
    public function updatedSelectedYear($value)
    {
        $this->selectedYear = $value;
    }

    protected function getListeners(): array
    {
        return ['selectedYear' => 'updatedSelectedYear'];
    }

    public function avgClosed($ticketId = null)
    {
        $year = $this->selectedYear ?? now()->year;

        $averageResponseTime = Ticket::where('status', 'closed')
            // ->when($year, fn($query) => $query->whereYear('created_at',  $year))
            ->join('ticket_massages as first_message', function ($join) {
                $year = Carbon::now()->format('Y') ?? date('Y');
                $join->on('tickets.id', '=', 'first_message.ticket_id')
                    ->whereRaw('first_message.id = (
                    SELECT MIN(id)
                    FROM ticket_massages
                    WHERE ticket_massages.ticket_id = tickets.id
                    OR YEAR(first_message.created_at) = '.$year.'
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
        if ($averageResponseTime === null) {
            return 'N/A';
        }

        return gmdate('i:s', $averageResponseTime);
    }
}
