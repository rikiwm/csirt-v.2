<?php

namespace App\Livewire;

use App\Mail\TicketCreateMail;
use App\Models\Ticket;
use App\Models\TicketMassage;
use App\Models\User;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;
use Livewire\Component;
use Filament\Resources\TicketResource\Pages\ViewTicket;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Support\Facades\Mail;

class ReplyTicket extends Component implements HasForms
{
    use InteractsWithForms;
    public $record;
    public ?array $data = [];
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('message')->columnSpan(12)
                ->toolbarButtons([
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',]),
                // ToggleButtons::make('status')
                // ->inline()
                // ->options([
                //    null => '-',
                //     0 => 'Verified',
                //     1 => 'Not Verified',
                // ])
                // ->colors([
                // null => 'info',
                //    0 => 'warning',
                //    1 => 'success',
                // ]),
                ])

            ->statePath('data');
    }
    public function mount(): void
    {
        $this->form->fill([]);
    }
    public function create(): void
    {
        $user = auth()->user();
        try {
            // create msg
            TicketMassage::create([
                'ticket_id' => $this->record->id,
                'user_id' => auth()->user()->id,
                'message' => $this->form->getState()['message'],
            ]);
            $data = $this->form->getState()['message'];

            $this->form->fill([]); // rempve
            $details = [
                'name' => 'John Doe',
                'message' => $data
            ];
            if ($user->hasRole('agen') || $user->hasRole('super_admin')) {
                $recipient = User::find($this->record->users_id);
                Mail::to($recipient)->queue(new TicketCreateMail($details)); // tomail admin
                if ($this->record->agent_id == null) {
                    $recorde = Ticket::find($this->record->id);
                    $recorde->agent_id = $user->id;
                    $recorde->save();
                    Log::info($recorde);
                }
            } else {
                $recipient = User::find($this->record->agent_id);
                Mail::to($recipient)->queue(new TicketCreateMail($details)); //tomail user

            }
            if ($recipient) {
                Notification::make()
                    ->title('New message form : '.auth()->user()->name)
                    ->body('Pesan : '.$data)
                    ->icon('heroicon-m-bell')
                    ->color('primary')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('View')
                            ->color('primary')
                            ->button()
                            ->markAsRead()
                            ->url('/app/tickets/'.$this->record->id, shouldOpenInNewTab: false),
                    ])
                    ->sendToDatabase($recipient);
            }
            $this->dispatch('refreshInfolist');
            Notification::make()
                ->success()
                ->title('✅ Success')
                ->send();

        } catch (\Exception $th) {
            Notification::make()->danger()->title('Error')->body($th->getMessage())->send();
        }
    }



    public function render()
    {
        return view('livewire.reply-ticket');
    }


}
