<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\Pages\ViewTicket;
use App\Filament\Resources\TicketResource\RelationManagers\MessagesRelationManager;
use App\Models\Ticket;
use App\Models\Type;
use App\Models\TicketMassage;
use App\Models\User;
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
use Filament\Tables\Columns\Layout\Split as LayoutSplit;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Indicator;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Support\Enums\ActionSize;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;
    protected static ?string $navigationIcon = 'heroicon-c-ticket';
    protected static ?string $navigationGroup = 'Ticket';
    protected $listeners = ['refreshInfolist' => '$refresh'];
    protected static ?string $recordTitleAttribute = 'subject';



    public static function form(Form $form): Form
    {
        return $form
        ->columns([
            'default' => 1,
            'lg' => 1,
            'xl' => 1,
            '2xl' => 1
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

                Split::make([
                    Section::make('Topik')->schema([
                        TextInput::make('subject')
                        // ->capitalize()
                        ->required()
                        ->maxLength(255)
                        ->validationMessages([
                            'required' => 'The :attribute not valid.',
                        ]),
                        RichEditor::make('description')
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
                            'undo',])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments_ticket')
                            ->fileAttachmentsVisibility('private')
                            ->validationMessages([
                                'required' => 'The :attribute not valid.',
                            ])
                            ->required(),
                    ]),
                    Section::make('Priority')->icon('heroicon-m-bug-ant')
                    ->schema([
                        Select::make('type_id')
                        ->required()
                        ->relationship('types', 'name')
                        ->multiple()
                        ->preload()
                        ->searchable(),
                        Select::make('priority')
                        ->options([
                            'low' => 'Low',
                            'medium' => 'Medium',
                            'high' => 'High',
                            'urgent' => 'Urgent',
                        ])->required()
                        ->default('low'),

                        Select::make('agent_id')->label('Assign to Agent')
                        ->relationship('agents', 'name')
                        ->required()
                        ->options(fn () => User::role('agen')->pluck('name', 'id'))
                        ->visible(fn () => auth()->user()->hasRole('super_admin')),
                    SpatieMediaLibraryFileUpload::make('ticket_media')
                    ->collection('ticket_media')
                    ->disk('public')
                    ->acceptedFileTypes(['application/pdf','jpg','jpeg','png'])
                    ->image()
                    ->rules(['mimetypes:image/jpeg,image/png,application/pdf'])
                    ->validationMessages([
                        'required' => 'The :attribute not Valid.',
                    ])
                    ->required()

                    ->label('File'),
                    ])->grow(false),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->striped(false)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('No')->rowIndex(),
                TextColumn::make('users.name')->label('Nama')->sortable()->searchable(),
                TextColumn::make('users.email')->label('Email')->sortable()->searchable(),
                TextColumn::make('created_at')->sortable()->date()->dateTimeTooltip(),
                TextColumn::make('subject')->sortable()->searchable(),
                TextColumn::make('priority')->label('Priority')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'low' => 'info',
                    'medium' => 'warning',
                    'high' => 'urgent',
                    'urgent' => 'danger',
                })->sortable()
                ->icon(fn (string $state): string => match ($state) {
                    'low' => 'heroicon-m-exclamation-circle',
                    'medium' => 'heroicon-m-exclamation-circle',
                    'high' => 'heroicon-m-exclamation-triangle',
                    'urgent' => 'heroicon-c-fire',
                })
                ->searchable()->numeric(),
                TextColumn::make('types.name')->sortable()->label('Insident')->badge()->searchable()->lineClamp(2)->icon('heroicon-m-tag'),
                TextColumn::make('status')->sortable()->label('Status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'open' => 'success',
                    'in_progress' => 'info',
                    'closed' => 'warning'
                })->searchable()
                ->icon(fn ($record) => match ($record->status) {
                        'open' => 'heroicon-m-lock-open',
                        'closed' => 'heroicon-m-lock-closed',
                        'in_progress' => 'heroicon-m-clock',
                    }),
                TextColumn::make('useragen.name')->label('Assign By')->searchable(),
                TextColumn::make('is_verified')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    '' => '',
                    '0' => 'danger',
                    '1' => 'success',
                })
                       ->label('Verified')
                       ->sortable()
                       ->searchable()
                       ->formatStateUsing(fn($state) => $state === null ? 'Not Processed' : ($state ? 'Verified' : 'Unverified')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->label('Trashed')
                ->visible(fn () => auth()->user()->hasRole('super_admin')),
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
                ->label('Insident')->options(fn() => Type::all()->pluck('name','id'))
                        ->selectablePlaceholder(false),

            ], layout: FiltersLayout::AboveContentCollapsible)
            ->filtersFormWidth(MaxWidth::FourExtraLarge)

            ->actions([
                ActionGroup::make([
                Tables\Actions\EditAction::make()->color('warning'),
                Tables\Actions\ViewAction::make()->modal(false)
                ->label('Detail')
                ->icon('heroicon-m-play')
                ->color('info'),

                Tables\Actions\Action::make('verified')
                    ->label('Verified')
                    ->color('success')
                ->icon('heroicon-m-check-badge')
                    ->visible(fn (Ticket $record): bool => auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('agen') && $record->is_verified === null)
                    ->requiresConfirmation()
                    ->modal(true)
                    ->action(fn (Ticket $record) => $record->update([
                        'is_verified' => true,
                        'status' => 'in_progress',
                        'reason' => null
                        ]))
                    ->successNotificationTitle('Ticket berhasil diUpdate'),

                    Tables\Actions\Action::make('non-verified')
                        ->modal('Tutup Ticket')
                        ->modalHeading('Attach Reason')
                        ->modalWidth('xl')
                        ->label('Non Verified')->form([
                            Textarea::make('reason')->label('Reason')->rows(3)->required(),
                        ])
                        ->icon('heroicon-m-exclamation-circle')
                        ->color('danger')
                        ->visible(fn (Ticket $record): bool => auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('agen') && $record->is_verified === null)
                        ->action(fn ($data, $record) => $record->update([
                            'is_verified' => false,
                            'status' => 'closed',
                            'reason' => $data['reason'],
                        ]))
                        ->successNotificationTitle('Ticket berhasil diUpdate'),
            ])->button()
            ->size(ActionSize::Small)
            ->label('Actions')
        ])
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
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
            // ->withoutGlobalScopes([
            //     SoftDeletingScope::class,
            // ]);
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
        'default' => 1,
        'md' => 1,
        'lg' => 1,
        'xl' => 1,
        '2xl' => 1
    ])
        ->schema([
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Ticket Detail')
                        ->schema([
                            InfolistsSplit::make([
                                ComponentsSection::make($infolist->record->code)->description('code')->schema([
                                    TextEntry::make('subject')->label('Subject')
                                    ->grow(false)
                                    ->size(TextEntry\TextEntrySize::Large)
                                    ->weight(FontWeight::Bold)->columns(2),

                                    Fieldset::make('Ticket')
                                    ->schema([
                                        TextEntry::make('status')->grow(false),
                                        TextEntry::make('priority')->label('Priority')->badge()->color(fn (string $state): string => match ($state) {
                                            'low' => 'secondary',
                                            'medium' => 'info',
                                            'high' => 'warning',
                                            'urgent' => 'danger'})->grow(false),
                                        TextEntry::make('types.name')->label('Insident')->badge()->grow(false),
                                        TextEntry::make('users.name')->grow(false),
                                        TextEntry::make('users.email')->grow(false),
                                        TextEntry::make('created_at')->date()->grow(false),
                                    ]),
                                    Fieldset::make('description')->schema([
                                        TextEntry::make('description')->label('Description')->html()->grow(false),

                                    ])

                                ])->columns(2),
                                ComponentsSection::make('Ticket Response')
                                ->description($infolist->record->updated_at)
                                ->relationship('messages')
                                ->collapsible()
                                ->persistCollapsed()
                                ->icon('heroicon-m-chat-bubble-left')
                                ->grow(false)
                                    ->schema([
                                        View::make('filament.pages.ticket.ticket-chat')
                                        ->columnSpan(2)
                                        ->viewData([
                                            'messages' => TicketMassage::where('ticket_id', $infolist->record->id)->with('user')->orderBy('created_at', 'desc')->get(),
                                            'record' => $infolist->record,
                                            'statuse' => $infolist->record->status
                                        ]),
                                ]),
                            ])->columns(2),
                        ]),
                    Tabs\Tab::make('Proof Of Concept')
                        ->schema([
                            View::make('ticket_media')
                            ->view('filament.pages.ticket.ticket-poc')
                            ->viewData(['data' => Ticket::find($infolist->record->id)]),
                            SpatieMediaLibraryImageEntry::make('ticket_media')->label('POC')->conversion('thumb')->collection('ticket_media')
                            ->defaultImageUrl(url('https://thumbs.dreamstime.com/b/no-image-available-icon-177641087.jpg'))->checkFileExistence(false)
                        ]),
                    Tabs\Tab::make('Get Reward')->visible(fn(Ticket $record) => $record->status === 'closed' && $record->is_verified === true)
                        ->icon('heroicon-m-bell')
                        ->iconPosition(IconPosition::After)
                        // ->badge(1)
                        ->schema([
                            View::make('ticket_media')
                            ->view('filament.pages.ticket.ticket-reward')
                            ->viewData(['data' => Ticket::find($infolist->record->id)]),
                        ]),
                    ])->contained(false),


            Actions::make([
                Action::make('close')
                    ->disabled(fn (Ticket $record) => $record->status === 'closed')
                    ->icon('heroicon-o-trash')->color(fn (Ticket $record) => $record->status === 'closed' ? 'gray' : 'danger')
                    ->requiresConfirmation()
                    ->label(fn ($record) => $record->status === 'closed' ? 'Ticket Closed' : 'Close Ticket')
                    ->action(function (Ticket $record) {
                        $record->where('id', $record->id)->update([
                            'status' => 'closed',
                        ]);
                        $recipient = User::find($record->users_id);
                        Notification::make('close')->title('Ticket Is Closed')
                        ->body('Ticket Telah di Tutup')->success()->sendToDatabase($recipient);
                    }),


            ])->alignment(Alignment::End)->visible(auth()->user()->hasRole('super_admin') || auth()->user()->id == $infolist->record->agent_id),
        ]);
}

    public function methodResultRefreshSelf()
    {
        $this->dispatch('refreshChat');
    }

}
