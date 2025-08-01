<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\Profile;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Filament\Notifications\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    // protected function onboardingAction(): Action
    // {
    //       return Action::make('onboarding')->label('Give me a feedback')
    //         ->visible(fn () => auth()->user()->id === $this->record->users_id)
    //         ->hidden(fn () => $this->record->status !== 'closed')
    //         ->form([
    //             Section::make('feedback')->description('Rating this Responese?')->schema([
    //                 Radio::make('feedback') ->label(false)

    //                 ->options([
    //                     '1' => '1',
    //                     '2' => '2',
    //                     '3' => '3',
    //                     '4' => '4',
    //                     '5' => '5',
    //                 ])
    //                 ->inline()
    //             ])

    //         ])
    //         ->modalFooterActionsAlignment(Alignment::Center)
    //         ->modalWidth('xl');
    // }
    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $code = Str::upper(Str::random(8));
        $data['code'] = $code.'-'.auth()->user()->id;
        $data['users_id'] = auth()->user()->id;
        $data['agent_id'] = auth()->user()->hasRole('super_admin') ? null : (auth()->user()->hasRole('agent') ? auth()->id() : null);
        // dd(('user'));
        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Tiket Berhasil Dibuat.';
    }


    protected function getCreatedNotification(): ?Notification
    {
        try {
            $user = auth()->user();
            $recipients = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['super_admin', 'agen']);
            })->get();
            if ($recipients->isNotEmpty()) {

                $details = [
                    'name' => $recipients->first()->name,
                    'body' =>  [
                        'code' => $this->record->code,
                        'subject' => $this->record->subject,
                        'description' => $this->record->description,
                        'priority' => $this->record->priority,
                        'link' => url('/app/tickets/'.$this->record->id),
                    ],
                ];
                // dd(());
                $this->sendMail($recipients, $details);
                return Notification::make()
                            ->title('Tiket Berhasil Dibuat.')
                            ->body('Informasi Tiket: '.$this->record->priority.' - '.$this->record->subject)
                            // ->visible(fn () => $user->hasRole('super_admin') || $user->hasRole('agen'))
                            ->actions([
                                Action::make('view')
                                        ->button()
                                        ->markAsRead()
                                        ->color('gray')
                                        ->url('/app/tickets/'.$this->record->id, shouldOpenInNewTab: false)
                                        ])
                            ->success()
                            ->sendToDatabase($recipients);
            }

        } catch (\Exception $e) {
            return Notification::make()
                                ->title('Notification Error')
                                ->body('Error sending notification: ' . $e->getMessage())
                                ->send();

        }
    }

    protected function onValidationSuccess(): void
    {
        Notification::make()
        ->title('Ticket Berhasil Dibuatasd')
        ->body('Tiket baru telah berhasil dibuat asdsad.')
        ->success()
        ->send();
    }
    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->body('Input Not Valid, please try again.')
            ->danger()
            ->send();
    }

    protected function sendMail($recipients, $details): void
    {
        Mail::to($recipients)->queue(new \App\Mail\TicketCreateMail($details));

    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


protected function getFormActions(): array
{
    $profile = Profile::where('users_id', auth()->id())->first();

    if (!auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen')) {
        return [
        $this->getCreateFormAction()->label('Save'),
        $this->getCancelFormAction()->label('Cancel'),
        ];
    }

    return [
        $this->getCreateFormAction()->label('Save'),
        $this->getCancelFormAction()->label('Cancel'),
    ];
}
    



}

