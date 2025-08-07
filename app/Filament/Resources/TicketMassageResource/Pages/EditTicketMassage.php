<?php

namespace App\Filament\Resources\TicketMassageResource\Pages;

use App\Filament\Resources\TicketMassageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketMassage extends EditRecord
{
    protected static string $resource = TicketMassageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
