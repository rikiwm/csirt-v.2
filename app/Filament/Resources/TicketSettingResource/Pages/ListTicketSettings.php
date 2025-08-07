<?php

namespace App\Filament\Resources\TicketSettingResource\Pages;

use App\Filament\Resources\TicketSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketSettings extends ListRecords
{
    protected static string $resource = TicketSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
