<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketMassage;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
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
use Filament\Support\Enums\ActionSize;
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

    // public $defaultAction = 'onboarding';


    // protected function onboardingAction(): Action
    // {
    //     return Action::make('onboarding')->label('Give me a feedback')
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

    protected function getHeaderActions(): array
    {
        return [
            Action::make('activity')->modal('Message Ticket')->modalHeading('Time Line')->modalWidth('4xl')->color('primary')->icon('heroicon-m-clock')->outlined()
                ->slideOver()->size(ActionSize::Small)
                ->modalWidth(MaxWidth::Large)
                ->label('Time Line')
                ->form([
                    ComponentsView::make('filament.card.time-line')
                    ->viewData(['data' => Ticket::find($this->record->id)])->columnSpanFull(),
                    ])
                ->modalSubmitAction(false),
            // Gift Reward TIcket
            Action::make('sertifikat')->visible(fn () => $this->record->is_reward !== 1)->disabled( fn () => $this->record->status !== 'closed')
                    ->label('Gift Reward')->size(ActionSize::Small)
                    ->modal('Sertifikat')
                    ->modalHeading('Sertifikat Apresiasi')
                    ->icon('heroicon-m-trophy')
                    ->color('gray')
                    ->slideOver()
                    ->modalWidth(MaxWidth::ExtraLarge)
                    ->hidden(fn () => !auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen'))
                    ->form([
                        Hidden::make('user_id')->default(auth()->user()->id),
                        FileUpload::make('file_path')
                            ->disk('public')
                            ->directory('ticket_reward')
                            ->visibility('public')
                            ->label('Upload Sertifikat')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                            ->required(),
                    ])
                        ->action(function (array $data, $livewire) {
                            $record = $livewire->record;
                            $filePath = is_array($data['file_path']) ? $data['file_path'][0] : $data['file_path'];
                            TicketAttachment::updateOrCreate(
                            ['ticket_id' => $record->id],
                                [
                                    'user_id' => $data['user_id'],
                                    'file_path' => $filePath,
                                ]
                            );
                            $record->update([
                                'is_reward' => true,
                                'is_duplicate' => false,
                            ]);

                            Notification::make()
                                ->title('Sertifikat berhasil ditambahkan.')
                                ->body('Dokumen sertifikat telah berhasil diunggah.')
                                ->success()
                                ->send();
                        })

        ];
    }

}
