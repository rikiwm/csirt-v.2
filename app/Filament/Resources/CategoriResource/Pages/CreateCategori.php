<?php

namespace App\Filament\Resources\CategoriResource\Pages;

use App\Filament\Resources\CategoriResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCategori extends CreateRecord
{
    protected static string $resource = CategoriResource::class;



    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Berhasil Menambahkan Kategori')
            ->success()
            ->send();
    }
}
