<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMenu extends CreateRecord
{
    protected static string $resource = MenuResource::class;

    public  bool $visible;
    public  string $save;

 protected function getRedirectUrl(): string
 {
    try {
        if ($this->data['type'] === 'page') {
            return url('app/pages/create');
        }else{
            return $this->getResource()::getUrl('index');

        }
    } catch (\Exception $e) {
        Notification::make()->danger()->title('Error')->body($e->getMessage())->send();

    }

 }


 protected function getFormActions($save = 'Save', $visible = false): array
 {

    if ($this->data['name'] == null) {
        $visible = true;

    } else {
        $this->visible = $visible;
    }

     return [
         $this->getCreateFormAction()->label('Save'),
         $this->getCancelFormAction()->label('Cancel')
     ];
 }



}
