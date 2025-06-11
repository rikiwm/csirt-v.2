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

        $profile = Profile::where('users_id', auth()->id())->first();
        $hasProfile = $profile !== null;
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus-circle')
                ->url($hasProfile ? route('filament.admin.resources.tickets.create') : route('filament.admin.auth.profile', ['record' => $profile]))
                ->label($hasProfile ? 'Create Ticket' : 'Lengkapi Data Profile Dulu'),
            // FilterAction::make('asd')
            //     ->form([
            //         DatePicker::make('startDate'),
            //         DatePicker::make('endDate'),
            //         // ...
            //     ]),
        ];
    }


    public function getTabs(): array
    {
        {
            $isAdmin = auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('agen');
            $userId = auth()->id();
            $statuses = ['open', 'in_progress', 'closed'];
            $icons = $isAdmin ? ['heroicon-m-lock-open', 'heroicon-m-clock', 'heroicon-m-lock-closed'] : ['heroicon-m-bug-ant', 'heroicon-m-bug-ant', 'heroicon-m-bug-ant'];
            $badgeColors = ['primary', 'success', 'success'];

            $tabs = collect($statuses)->mapWithKeys(function ($status, $index) use ($isAdmin, $userId, $icons, $badgeColors) {
                $query = Ticket::query()->where('status', $status);
                if (!$isAdmin) {
                    $query->where('users_id', $userId);
                }
                return [
                    ucfirst($status) => Tab::make()
                        ->icon($icons[$index])
                        ->badge($query->count())
                        ->badgeColor($badgeColors[$index])
                        ->query(fn ($query) => $query->where('status', $status)),
                ];
            })->toArray();

            return $tabs;
}
    }


}
