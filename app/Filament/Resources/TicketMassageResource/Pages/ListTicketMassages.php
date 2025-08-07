<?php

namespace App\Filament\Resources\TicketMassageResource\Pages;

use App\Filament\Resources\TicketMassageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketMassages extends ListRecords
{
    protected static string $resource = TicketMassageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
