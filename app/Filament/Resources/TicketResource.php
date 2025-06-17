<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\Pages\ViewTicket;
use App\Filament\Resources\TicketResource\RelationManagers\MessagesRelationManager;
use App\Models\Ticket;
use App\Models\Type;
use App\Models\TicketMassage;
use App\Models\User;
use App\Models\Profile;
use App\Models\TicketAttachment;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\View;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Split as InfolistsSplit;
use Filament\Infolists\Components\Fieldset;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\Summarizers\Range;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\Split as ComponentsSplit;
use Filament\Support\Enums\Alignment;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\ViewEntry;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\Layout\Split as LayoutSplit;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Indicator;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Mail;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Grouping\Group;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Get;


class TicketResource extends Resource implements HasForms
{
    use InteractsWithForms;

    protected static ?string $model = Ticket::class;
    protected static ?string $navigationIcon = 'heroicon-c-ticket';
    // protected static ?string $navigationGroup = 'Ticket';
    protected $listeners = ['refreshInfolist' => '$refresh'];
    protected static ?string $recordTitleAttribute = 'subject';


    public static function form(Form $form): Form
    {
    // $profile = Profile::where('users_id', auth()->id())->first();
    
    //     if (!$profile) {
    //         return $form->schema([
    //             Placeholder::make('LengkapiProfil')
    //                 ->content('⚠️ Anda harus melengkapi profil terlebih dahulu sebelum mengisi form tiket.')
    //                 ->columnSpanFull()
    //         ]);
    //     }

        return $form
            ->columns([
                'default' => 1,
                'lg' => 2,
                'xl' => 2,
                '2xl' => 2
            ])
            ->schema([
                Section::make('Instructions')->icon('heroicon-o-document-text')->collapsible()->collapsed()->schema([
                    Placeholder::make('Tutorial')
                        ->content(new HtmlString('
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h2 class="mb-2 text-lg font-semibold">Instructions</h2>
                                <ul class="pl-4 list-disc">
                                    <li>Use the form below to create a new ticket.</li>
                                    <li>Enter the subject and description of the ticket.</li>
                                    <li>Select the priority and category of the ticket.</li>
                                    <li>Attach any relevant files or images to the ticket.</li>
                                    <li>Click on "Submit" to create the ticket.</li>
                                </ul>
                            </div>
                            <div>
                                <h2 class="mb-2 text-lg font-semibold">Example</h2>
                                <ul class="pl-4 list-disc">
                                    <li>Subject: "My ticket subject"</li>
                                    <li>Description: "This is the description of my ticket"</li>
                                    <li>Priority: "High"</li>
                                    <li>Category: "Support"</li>
                                    <li>File: "image.jpg"</li>
                                </ul>
                            </div>
                        </div>
                            ')),

                ]),
                Section::make('Topik')->icon('heroicon-m-tag')->schema([
                    TextInput::make('subject')
                        ->required()->helperText('Your subject here')
                        ->maxLength(255)
                        ->validationMessages([
                            'required' => 'The :attribute not valid.',
                        ])->columnSpan(1),
                    TextInput::make('domain')->placeholder('Ex: contoh.contoh.go.id')
                        ->required()->helperText('domain Vuln')
                        ->maxLength(255)
                        ->validationMessages([
                            'required' => 'The :attribute not valid.',
                        ]),
                    RichEditor::make('description')->columnSpan(2)
                        ->toolbarButtons([
                            'attachFiles',
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
                            'undo',
                        ])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('attachments_ticket')
                        ->fileAttachmentsVisibility('private')
                        ->validationMessages([
                            'required' => 'The :attribute not valid.',
                        ])->hint('Description Vuln')->hintColor('warning')
                        ->required(),
                ])->columnSpan(1),
                Section::make('Category and Priority')->icon('heroicon-m-tag')
                    ->schema([
                        Select::make('type_id')->label('Insiden Type')
                            ->required()->helperText('select type here')
                            ->relationship('types', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()->columnSpan(1),
                        Select::make('priority')->columnSpan(1)->label('Priority Vuln')
                            ->options([
                                'low' => 'Low',
                                'medium' => 'Medium',
                                'high' => 'High',
                                'urgent' => 'Urgent',
                            ])->required()->helperText('Select priority here')
                            ->default('low'),

                        Select::make('agent_id')->label('Assign to Agent')
                            ->relationship('agents', 'name')
                            ->required()
                            ->options(fn() => User::role('agen')->pluck('name', 'id'))
                            ->visible(fn() => auth()->user()->hasRole('super_admin')),
                        SpatieMediaLibraryFileUpload::make('ticket_media')
                            ->collection('ticket_media')
                            ->disk('public')
                            // ->acceptedFileTypes(['application/pdf','image/jpg', 'image/png', 'image/jpeg'])
                            // ->image()
                            ->rules(['mimetypes:image/jpeg,image/png,application/pdf', 'max:2048'])
                            ->validationMessages([
                                'required' => 'The :attribute not Valid.',
                            ])
                            ->required()
                            ->columnSpan(2)
                            ->label('Proof of Concept'),
                            TextArea::make('recomendation')->columnSpan(3)->label('Recommendation Insiden')->maxLength(255)->hint('Recommendation Insiden : Opsional')->hintColor('warning'),
                    ])->columnSpan(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading(false)
            ->query(Ticket::with(['users', 'types', 'useragen'])->when(!auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen'), function ($query) {
                $query->where('users_id', auth()->id());
            }))
            ->striped(false)
            ->defaultSort('created_at', 'desc')
            ->groups([
                Group::make('priority')
                ->collapsible(),
            ])
            ->columns([

                TextColumn::make('No')->rowIndex()->size(TextColumn\TextColumnSize::ExtraSmall)->alignment(Alignment::Start),
                TextColumn::make('users.name')->label('Nama')->sortable()->searchable()->size(TextColumn\TextColumnSize::ExtraSmall)->alignment(Alignment::Start)->formatStateUsing(fn (string $state): string => Str::headline($state))
                ->description(fn ($record): HtmlString => new HtmlString('<span class="text-xs text-gray-500 dark:text-gray-400">'.$record->users->email.'</span>')),
                TextColumn::make('types.name')->sortable()->label('Insident')->badge()->searchable(),
                TextColumn::make('subject')->sortable()->searchable()->limit(60)->tooltip('subject')->lineClamp(2)->size(TextColumn\TextColumnSize::ExtraSmall)->description(fn ($record): HtmlString => new HtmlString('<span class="text-xs text-gray-500 dark:text-gray-400">'.$record->created_at->diffForHumans().'</span>')),
                TextColumn::make('priority')->label('Priority')->badge()->alignment(Alignment::Start)
                    ->color(fn(string $state): string => match ($state) {
                        'low' => 'primary',
                        'medium' => 'warning',
                        'high' => 'urgent',
                        'urgent' => 'danger',
                    })->sortable()
                    ->icon(fn(string $state): string => match ($state) {
                        'low' => 'heroicon-o-exclamation-circle',
                        'medium' => 'heroicon-m-exclamation-circle',
                        'high' => 'heroicon-m-exclamation-triangle',
                        'urgent' => 'heroicon-c-fire',
                    })
                    ->searchable()->numeric()->extraAttributes(fn ($record) => $record->priority === 'urgent' ? ['class' => 'animate-pulse'] : []),
                TextColumn::make('status')->sortable()->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'open' => 'success',
                        'in_progress' => 'info',
                        'closed' => 'warning'
                    })->searchable()
                    ->icon(fn($record) => match ($record->status) {
                        'open' => 'heroicon-m-lock-open',
                        'closed' => 'heroicon-m-lock-closed',
                        'in_progress' => 'heroicon-m-clock',
                    }),
                TextColumn::make('useragen.name')->label('Agent By')->searchable(),
                // TextColumn::make('is_verified')
                //     ->badge()
                //     ->color(fn(string $state): string => match ($state) {
                //         'null' => 'gray',
                //         '0' => 'danger',
                //         '1' => 'success',
                //     })
                //     ->label('Verified')
                //     ->sortable()
                //     ->searchable()
                //     ->formatStateUsing(fn($record) => $record->is_verified === null ? 'Not Processed' : ($record->is_verified ? 'Verified' : 'Unverified')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->label('Trashed')
                    ->visible(fn() => auth()->user()->hasRole('super_admin')),
                SelectFilter::make('status')
                    ->multiple()->options([
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'closed' => 'Closed',
                    ])
                    ->default('draft')
                    ->selectablePlaceholder(false),
                SelectFilter::make('priority')->multiple()->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                    'urgent' => 'Urgent',
                ])
                    ->selectablePlaceholder(false),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['from'])->toFormattedDateString())
                                ->removeField('from');
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['until'])->toFormattedDateString())
                                ->removeField('until');
                        }

                        return $indicators;
                    })->columns(2),
                SelectFilter::make('types.name')
                    ->relationship('types', 'name')
                    ->label('Insident')->options(fn() => Type::all()->pluck('name', 'id'))
                    ->selectablePlaceholder(false),

            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersFormWidth(MaxWidth::FourExtraLarge)

            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()->label('Edit')
                        ->color('warning')
                        ->visible(fn(Ticket $record): bool =>
                        auth()->user()->hasRole('super_admin') ||
                            auth()->user()->hasRole('agen')),
                    Tables\Actions\ViewAction::make('view')->modal(false)
                        ->label('Detail')
                        ->icon('heroicon-m-play')
                        ->color('info'),
                    Tables\Actions\Action::make('verified')
                        ->label('Verified')
                        ->color('success')
                        ->icon('heroicon-m-check-badge')
                        ->visible(fn(Ticket $record): bool => auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('agen') && $record->is_verified === null)
                        ->hidden(fn(Ticket $record): bool => $record->is_verified === 1)
                        ->requiresConfirmation()
                        ->modal(true)
                        ->action(fn(Ticket $record) => $record->update([
                            'is_verified' => true,
                            'status' => 'in_progress',
                            'reason' => null
                        ]))
                        ->successNotificationTitle('Ticket berhasil diUpdate'),

                    Tables\Actions\Action::make('non-verified')
                        ->modal('Tutup Ticket')
                        ->modalHeading('Attach Reason')
                        ->modalWidth('lg')
                        ->label('Non Verified')
                        ->form([
                            Textarea::make('reason')->label('Reason Ticket')->helperText('alasan No verif...')->rows(3)->required(),
                        ])
                        ->icon('heroicon-m-exclamation-circle')
                        ->color('danger')
                        ->visible(fn(Ticket $record): bool => auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('agen') && $record->is_verified === null)
                        ->hidden(fn(Ticket $record): bool => $record->is_verified === 0)
                        ->action(fn($data, $record) => $record->update([
                            'is_verified' => false,
                            'status' => 'closed',
                            'reason' => $data['reason'],
                        ]))
                        ->successNotificationTitle('Ticket berhasil diUpdate'),
                ])->icon('heroicon-s-list-bullet')
                    ->size(ActionSize::Small)
                    ->label(false)
            ])->recordUrl(false)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // MessagesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
       
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
            'view' => Pages\ViewTicket::route('/{record}'),

        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['users', 'types','messages', 'useragen', 'useragen.roles', 'users.roles']);
        if (!auth()->user()->hasRole('super_admin') && !auth()->user()->hasRole('agen')) {
            $query->where('users_id', auth()->id());
        }
        if (auth()->user()->hasRole('super_admin')) {
            $query->withTrashed();
        }
        return $query;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns([
                'xs' => 1,
                'md' => 1,
                'lg' => 1,
            ])
            ->schema([

                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Ticket Detail')->icon('heroicon-m-bell')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        InfolistsSplit::make([
                                            ComponentsSection::make(
                                                $infolist->record->types[0]->name.' - '. Str::upper($infolist->record->domain) ?? null
                                                )->description('Ticket Created : ' . $infolist->record->created_at)->schema([
                                                TextEntry::make('subject')->label('Subject')
                                                    ->size(TextEntry\TextEntrySize::Large)
                                                    ->weight(FontWeight::Bold),
                                                Fieldset::make('Ticket')
                                                    ->schema([
                                                        TextEntry::make('status')->icon('heroicon-o-check-circle'),
                                                        TextEntry::make('priority')->label('Priority')->badge()->color(fn(string $state): string => match ($state) {
                                                            'low' => 'secondary',
                                                            'medium' => 'info',
                                                            'high' => 'warning',
                                                            'urgent' => 'danger'
                                                        })->grow(true)->icon('heroicon-o-check-circle'),
                                                        TextEntry::make('types.name')->label('Insident')->badge()->grow(true)->icon('heroicon-o-check-circle'),
                                                        TextEntry::make('users.name')->grow(true)->icon('heroicon-o-check-circle'),
                                                        TextEntry::make('users.email')->grow(true)->icon('heroicon-o-check-circle'),
                                                        TextEntry::make('created_at')->date()->grow(true)->icon('heroicon-o-check-circle'),
                                                    ]),
                                                Fieldset::make('description')->schema([
                                                    TextEntry::make('description')->label('Description')->html()->grow(true)->prose()
                                                ])
                                            ])->headerActions([
                                        Action::make('download')->label(false)->color('primary')->icon('heroicon-m-printer')->outlined()->size(ActionSize::ExtraSmall)->extraAttributes(['class' => 'rounded-full pe-2'])
                                                    ->url(route('summary-report.print', [
                                                        'id' => $infolist->record->id
                                                        ]), shouldOpenInNewTab: true),
                                        Action::make('valid')->size(ActionSize::Small)
                                                ->icon(fn(Ticket $record) => $record->is_verified === null ? 'heroicon-o-question-mark-circle' : ($record->is_verified == false ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle'))
                                                ->color(fn(Ticket $record) => $record->is_verified === null ? 'warning' : ($record->is_verified == false ? 'danger' : 'success'))
                                                ->outlined()
                                                ->requiresConfirmation()
                                                ->label(fn(Ticket $record) => $record->is_verified === null ? 'Belum  Terverified' : (($record->is_verified == false) ? 'Tidak  Verified' : 'Valid'))
                                                 ->visible(fn(Ticket $record): bool => auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('agen'))
                                                ->disabled(fn(Ticket $record): bool => $record->is_verified === 1)
                                                ->requiresConfirmation()
                                                ->modal(true)
                                                ->modalIcon(false)
                                                ->modalHeading('Insident Ticket : '.$infolist->record->types[0]->name)
                                                ->modalDescription('Subject : '.$infolist->record->subject)->modalContent(new HtmlString('
                                                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                                                    <p class="text-sm text-gray-600 dark:text-gray-400">'. $infolist->record->description .'</p>
                                                                    </p>
                                                                    </span>'))
                                                ->form([
                                             ToggleButtons::make('is_verified')
                                                    ->boolean()
                                                    ->label('Apakah Verified')
                                                    ->inline()
                                                    ->live() // Perubahan langsung terdeteksi (reactive)
                                                    ->afterStateUpdated(fn (Set $set, $state) => $set('status', match($state) {
                                                        true => 'in_progress',
                                                        false => 'closed',
                                                        default => 'open',
                                                    })),
                                            ToggleButtons::make('is_duplicate')
                                                    ->boolean()->default(false)
                                                    ->label('Apakah Duplicate')
                                                    ->inline()->default(false)
                                                    ->visible(fn (Get $get) => $get('is_verified') == null || $get('is_verified') == true )
                                                    ->live()->afterStateUpdated(fn (Set $set, $state) => $set('reason', $state)),
                                            Textarea::make('reason')->live()
                                                    ->visible(fn (Get $get) => $get('is_verified') == false && $get('is_duplicate') == false )
                                                    ->label('Alasan Tidak Valid')
                                                    ->helperText('Alasan jika tidak verified.')
                                                    ->rows(3),
                                        Textarea::make('duplicate_details')->live()
                                                    ->visible(fn (Get $get) => $get('is_duplicate') == true )
                                                    ->label('Duplicate Details Ticket')
                                                    ->helperText('Alasan jika tidak Duplicate.')
                                                    ->rows(3),

                                          Radio::make('status')
                                                ->label('Status Tiket')
                                                ->live()
                                                ->options([
                                                    'open' => 'Open',
                                                    'in_progress' => 'In Progress',
                                                    'closed' => 'Closed',
                                                ])
                                                ->default('open')
                                                ->helperText('Status tiket setelah verifikasi')
                                                ->inline()
                                                
                                                ])
                                                    ->action(function (Ticket $record, array $data) {
                                                        $updateData = [
                                                            'is_verified' => $data['is_verified'],
                                                            'is_duplicate' => $data['is_duplicate'] ?? null,
                                                            'reason' => $data['reason'] ?? null,
                                                            'status' => $data['status'],
                                                            'duplicate_details' =>  $data['duplicate_details'] ?? null ,
                                                            'time_prosess_ticket' => null,
                                                            'is_reward' => null,
                                                        ];

                                                        if ($data['status'] === 'closed') {
                                                            $updateData['time_close_ticket'] = now();
                                                            $updateData['is_reward'] = false;
                                                        }

                                                        if ($data['status'] === 'in_progress') {
                                                            $updateData['time_prosess_ticket'] = now();
                                                        }

                                                    if (($data['is_duplicate']) == true) {
                                                            $updateData['time_prosess_ticket'] = now();
                                                            $updateData['duplicate_details'] = 'Insiden Telah di laporkan sebelum ini!';
                                                        }
                                                        $record->update($updateData);
                                                    })
                                                    

                                            ->modalFooterActionsAlignment(Alignment::Center),
                                            // Action::make('status_tickett')->size(ActionSize::Small)
                                            // ->disabled(fn(Ticket $record) => $record->status === 'closed')->color(fn(Ticket $record) => $record->status === 'closed' ? 'gray' : 'success') ->label(fn($record) => $record->status === 'closed' ? 'Ticket Closed' : 'Status Open')
                                            // ->visible(fn(Ticket $record): bool => auth()->user()->hasRole('user')),
                                            // Colosing TIcket
                                        Action::make('close')->size(ActionSize::Small)
                                                ->disabled(fn(Ticket $record) => $record->status === 'closed')
                                                ->icon('heroicon-o-trash')->color(fn(Ticket $record) => $record->status === 'closed' ? 'gray' : 'danger')
                                                ->requiresConfirmation()
                                                ->label(fn($record) => $record->status === 'closed' ? 'Ticket Closed' : 'Close Ticket')->requiresConfirmation()
                                                ->modal(true)
                                                ->modalIcon(false)
                                                ->action(function (Ticket $record) {
                                                    $record->where('id', $record->id)->update([
                                                        'status' => 'closed',
                                                        'time_close_ticket' => now()
                                                    ]);
                                                    $recipient = User::find($record->users_id);
                                                    $details = [
                                                        'name' => $recipient->name,
                                                        'body' =>  [
                                                            'code' => '',
                                                            'subject' => $record->subject,
                                                            'description' => $record->subject,
                                                            'priority' => '',
                                                            'link' => '',
                                                        ],
                                                    ];
                                                    Mail::to($recipient)->queue(new \App\Mail\TicketRespons($details));
                                                    Notification::make('close')->title('Ticket Is Closed')
                                                        ->body('Ticket Telah di Tutup')
                                                        ->success()
                                                        ->sendToDatabase($recipient);
                                                })
                                            ->visible(fn(): bool => auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('agen')),

                                            ]),
                                                    ])->columnSpan(2),
                                                            ComponentsSection::make('chat')->description('Chat Form')->label('Form Message')->icon('heroicon-m-envelope')->schema([
                                                                View::make('filament.pages.ticket.ticket-chat')->extraAttributes(['class' => 'overflow-hidden overflow-y-auto'])
                                                                    ->viewData([
                                                                        'messages' => TicketMassage::where('ticket_id', $infolist->record->id)->with('user')->orderBy('created_at', 'desc')->get(),
                                                                        'record' => $infolist->record,
                                                                        'statuse' => $infolist->record->status
                                                                    ])->columnSpanFull()
                                                            ])->columnSpan(1)
                                                        ]),
                                                ]),
                        Tabs\Tab::make('Proof Of Concept')->icon('heroicon-m-bell')
                            ->schema([
                                View::make('ticket_media')
                                    ->view('filament.pages.ticket.ticket-poc')
                                    ->viewData(['data' => Ticket::find($infolist->record->id)]),
                                SpatieMediaLibraryImageEntry::make('ticket_media')->label('POC')->conversion('thumb')->collection('ticket_media')
                                    ->defaultImageUrl(url('https://thumbs.dreamstime.com/b/no-image-available-icon-177641087.jpg'))->checkFileExistence(false)
                            ]),

                        Tabs\Tab::make('Get Reward')
                        ->hidden(fn(Ticket $record) => $record->is_reward === null || $record->is_reward === false)->icon('heroicon-m-bell')->iconPosition(IconPosition::After)
                            ->schema([
                                View::make('ticket_media')
                                    ->view('filament.pages.ticket.ticket-reward')
                                    ->viewData(['data' => TicketAttachment::with('ticketreward')->where('ticket_id',$infolist->record->id)->first() ?? null]),
                            ]),
                    ])->contained(false),
            ]);
    }

    public function methodResultRefreshSelf()
    {
        $this->dispatch('refreshChat');
        $this->emit('ViewTicket', $infolist->record->id);
    }
}
