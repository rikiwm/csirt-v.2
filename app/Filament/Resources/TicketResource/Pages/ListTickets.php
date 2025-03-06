<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Filament\Resources\TicketResource\Widgets\TicketOverview;
use App\Models\Profile;
use App\Models\Ticket;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    use HasFiltersForm, HasFiltersAction;
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {


        return [
            Actions\CreateAction::make()->icon('heroicon-o-plus-circle')->hidden(function (Profile $profile): bool {
                if ($profile->when !== null) {
                    return true;
                } else {
                    return false;
                    // return redirect()->route('filament.resources.users.edit', ['record' => $profile]);
                }
            }),
            FilterAction::make('asd')
            ->form([
                DatePicker::make('startDate'),
                DatePicker::make('endDate'),
                // ...
            ]),
        ];
    }

   private function nullProfile(Profile $profile): bool
   {
        if ($profile->when !== null) {
            return true;
        } else {
            return false;
        }
    }


    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //        TicketOverview::class
    //     ];
    // }

    public function getTabs(): array
    {
        {
            if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('agen')) {
                $tabs = [
                    'Open' => Tab::make()->icon('heroicon-m-lock-open')->badge(Ticket::query()->where('status', 'open')->count())->badgeColor('primary')
                    ->query(fn ($query) => $query->where('status', 'open')),
                    'In Progress' => Tab::make()->icon('heroicon-m-clock')
                    ->badge(Ticket::query()->where('status', 'in_progress')->count())->badgeColor('success')
                    ->query(fn ($query) => $query->where('status', 'in_progress')),
                    'Closed' => Tab::make()->icon('heroicon-m-lock-closed')
                    ->badge(Ticket::query()->where('status', 'closed')->count())->badgeColor('success')
                    ->query(fn ($query) => $query->where('status', 'closed')),
                ];
            }else{

            $tabs = [
                'Open' => Tab::make()->icon('heroicon-m-bug-ant')
                ->badge(Ticket::query()->where('users_id', auth()->id())->where('status', 'open')->count())
                ->badgeColor('primary')
                ->query(fn ($query) => $query->where('status', 'open')),
                'In Progress' => Tab::make()->icon('heroicon-m-bug-ant')
                ->badge(Ticket::query()->where('users_id', auth()->id())->where('status', 'in_progress')->count())
                ->query(fn ($query) => $query->where('status', 'in_progress')),
                'Closed' => Tab::make()->icon('heroicon-m-bug-ant')
                ->badge(Ticket::query()->where('users_id', auth()->id())->where('status', 'closed')->count())
                ->query(fn ($query) => $query->where('status', 'closed')),
            ];
        }

            return $tabs;
        }
    }


}
