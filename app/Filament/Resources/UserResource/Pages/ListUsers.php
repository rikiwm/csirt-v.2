<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'Agen' => Tab::make()->icon('heroicon-m-user')
            ->badge(User::query()->whereHas('roles', fn ($q) => $q->where('name', 'agen'))->count())
            ->badgeColor('primary')
            ->query(fn ($query) => $query->whereHas('roles', fn ($q) => $q->where('name', 'agen'))),
            'User' => Tab::make()->icon('heroicon-m-user')
            ->badge(User::query()->whereHas('roles', fn ($q) => $q->where('name', 'user'))->count())
            ->badgeColor('primary')
            ->query(fn ($query) => $query->whereHas('roles', fn ($q) => $q->where('name', 'user'))),
        ];
           return $tabs;
    }
}
