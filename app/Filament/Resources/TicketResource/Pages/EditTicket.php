<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\TicketMassage;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;
    // public $defaultAction = 'onboarding';
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
            // Action::make('message')->modal('Tutup Ticket')->modalHeading('Reply')->modalWidth('xl')
            // ->label('Massage')->form([
            //     Textarea::make('message')->required(),
            // ])
            // ->action(fn ($data, $record) => TicketMassage::create([
            //     'ticket_id' => $record->id,
            //     'user_id' => auth()->user()->id,
            //     'message' => $data['message'],
            // ]))
            // ->successNotificationTitle('Ticket berhasil ditutup'),

        ];
    }

    // public function onboardingAction(): Action
    // {
    //     return Action::make('onboarding')
    //         ->modalHeading('Welcome')->visible(false)
    //         ->modalWidth('xl');
    // }

    protected function getActions(): array
    {
        return [
            //
        ];
    }

//     public function view(ViewRecord $page): ViewRecord
// {
//     return $page
//         ->schema([
//             Textarea::make('message')
//                 ->label('Kirim Pesan')
//                 ->rows(3)
//                 ->required(),

//             Action::make('sendMessage')
//                 ->label('Kirim')
//                 ->action(fn ($data, $record) => TicketMassage::create([
//                     'ticket_id' => $record->id,
//                     'user_id' => auth()->user()->id,
//                     'message' => $data['message'],
//                 ]))
//                 ->successNotificationTitle('Pesan berhasil dikirim'),
//         ]);
// }

}
