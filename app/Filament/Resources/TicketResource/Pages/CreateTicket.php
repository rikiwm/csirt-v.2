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
class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $code = Str::upper(Str::random(8));
        $data['code'] = $code.'-'.auth()->user()->id;
        $data['users_id'] = auth()->user()->id;
        $data['agent_id'] = auth()->user()->hasRole('super_admin') ? null : (auth()->user()->hasRole('agent') ? auth()->id() : null);
        // dd(('user'));
        return $data;
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
                    'name' => 'John Doe',
                    'message' => 'Tiket Baru'
                ];
                $this->sendMail($recipients, $details);
                return Notification::make()
                            ->title('Ticket Created')
                            ->body('A new ticket has been created.')
                            // ->visible(fn () => $user->hasRole('super_admin') || $user->hasRole('agen'))
                            ->actions([
                                Action::make('view')
                                        ->button()
                                        ->markAsRead()
                                        ->color('gray')
                                        ->url('/app/tickets/'.$this->record->id, shouldOpenInNewTab: false),

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
        ->title('Ticket Created')
        ->body('A new ticket has been created.')
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



}

