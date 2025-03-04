<?php

namespace App\Filament\Resources\TicketSettingResource\Pages;

use App\Filament\Resources\TicketSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketSetting extends EditRecord
{
    protected static string $resource = TicketSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
