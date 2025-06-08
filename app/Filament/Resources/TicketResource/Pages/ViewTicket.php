<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\TicketMassage;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\View as ComponentsView;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\ImageFile;


class ViewTicket extends ViewRecord
{
    protected $listeners = ['refreshInfolist' => '$refresh'];
    protected static string $resource = TicketResource::class;

    protected ?string $heading = 'Detail Ticket';

    public $defaultAction = 'onboarding';


    protected function onboardingAction(): Action
    {

            return Action::make('onboarding')->label('Give me a feedback')
            ->visible(fn () => auth()->user()->id === $this->record->users_id)
            ->hidden(fn () => $this->record->status !== 'closed')
            ->form([
                Section::make('feedback')->description('Rating this Responese?')->schema([
                    Radio::make('feedback') ->label(false)

                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ])
                    ->inline()
                ])

            ])
            ->modalFooterActionsAlignment(Alignment::Center)
            ->modalWidth('xl');
    }

    // protected function getHeaderActions(): array
    // {
    //     return [

    //         Action::make('message')->modal('Message Ticket')->modalHeading('Reply')->modalWidth('4xl')->icon('heroicon-m-envelope')
    //         ->hidden(fn ($record) => $record->status == 'closed')
    //         ->slideOver()
    //         ->modalWidth(MaxWidth::ExtraSmall)
    //         ->label('Massage')
    //         ->form([
    //             MarkdownEditor::make('message')->required(),
    //         ])
    //         ->action(function ($data, $record) {
    //             $user = auth()->user();
    //             TicketMassage::create([
    //                 'ticket_id' => $record->id,
    //                 'user_id' => auth()->user()->id,
    //                 'message' => $data['message'],
    //             ]);
    //             $this->refreshFormData([]);
    //             if ($user->hasRole('agen') || $user->hasRole('super_admin')) {
    //                 $recipient = User::find($record->users_id);
    //                 if ($record->agent_id == null) {
    //                     $recorde = Ticket::find($record->id);
    //                     $recorde->agent_id = $user->id;
    //                     $recorde->save();
    //                     Log::info($recorde);
    //                 }
    //             } else {
    //                 $recipient = User::find($record->agent_id);
    //             }
    //             if ($recipient) {
    //                 Notification::make()
    //                     ->title('New message')->body(new HtmlString($data['message']))
    //                     ->icon('heroicon-m-bell')
    //                     ->color('primary')
    //                     ->actions([
    //                         \Filament\Notifications\Actions\Action::make('View')
    //                             ->color('primary')->button()
    //                             ->url('/app/tickets/'.$record->id, shouldOpenInNewTab: false),
    //                     ])
    //                     ->sendToDatabase($recipient);
    //             }
    //             Notification::make()
    //                 ->title('Send Success')->body(new HtmlString($data['message']))
    //                 ->send();
    //         })
    //     ];
    // }

    public function form(Form $form): Form
    {

        return $form
        ->columns([
            'default' => 1,
            'lg' => 1,
            'xl' => 1,
            '2xl' => 1
        ])

        ->schema([
            Section::make('Ticket')->icon('heroicon-m-bug-ant')->schema([
                Textarea::make('subject'),
                Textarea::make('description'),
            ])->grow(false),
                Split::make([
                    Section::make('Ticket Message')->label(false)
                    // ->footerActions([
                    //     Action::make('message')->modal('Message Ticket')->modalHeading('Reply')->modalWidth('xl')
                    // ])
                    ->schema([
                        Repeater::make('messages')->label(false)
                        ->relationship('messages')
                        ->schema([
                            Placeholder::make('user')
                            ->label(fn ($record) => $record->user?->name)
                            ->content(
                                fn ($record) => $record->created_at->diffForHumans(),
                                ),
                            Placeholder::make('message')
                                ->content(fn ($record) => $record->message),
                        ])->itemLabel(false)
                            ->columns(1),
                            Textarea::make('new_message')
                            ->label('Ketik pesan baru')->disabled(false)
                            ->required(),
                        ]),

                    Section::make('Priority')->icon('heroicon-m-bug-ant')->schema([
                        ComponentsView::make('filament.pages.ticket.ticket-chat')->schema([
                        ]),
                        Select::make('type_id')
                        ->relationship('types', 'name') // Relasi ke model Category
                        ->multiple()
                        ->preload()
                        ->searchable(),
                        Select::make('priority')->options([
                            'low' => 'Low',
                            'medium' => 'Medium',
                            'high' => 'High',
                            'urgent' => 'Urgent',
                        ])->required()->default('low'),
                        SpatieMediaLibraryFileUpload::make('ticket_media')->collection('ticket_media')->disk('public')->label('File'),
                        ]),

                    ]),
                ]);
    }



}
