<?php

namespace App\Filament\Resources\SettingWebResource\Pages;

use App\Filament\Resources\SettingWebResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSettingWeb extends CreateRecord
{
    protected static string $resource = SettingWebResource::class;

    protected function getRedirectUrl(): string
    {
        \Artisan::call('config:clear');
        return $this->getResource()::getUrl('index');
    }
    
}
