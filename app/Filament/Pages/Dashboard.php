<?php

namespace App\Filament\Pages;

use App\Models\Type;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Pages\Dashboard as PagesDashboard;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;


class Dashboard extends BaseDashboard
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    // protected static ?string $title = 'Finance dashboard';
    // protected static string $view = 'filament.pages.dashboard';
    use HasFiltersAction, HasFiltersForm;

    protected function getHeaderActions(): array
    {
        return [
            FilterAction::make('filter')
                ->icon('heroicon-o-calendar')
                ->form([
                    DatePicker::make('startDate')
                    ->prefix('Star')
                    ->suffixActions([
                        ActionsAction::make('reset')->icon('heroicon-o-trash')
                        ->action(fn (callable $set) => $set('startDate', null)),
                    ])
                    ->native(false)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('endDate', $state))->live(onBlur:true),

                DatePicker::make('endDate')
                    ->prefix('End')
                    ->suffixActions([
                        ActionsAction::make('reset')->icon('heroicon-o-trash')
                        ->action(fn (callable $set) => $set('endDate', null)),
                    ])
                    ->native(false)->default(null)
                    ->minDate(fn ($get) => $get('startDate')),
                Select::make('type_id')->label('insiden')
                    ->options(fn () => Type::pluck('name', 'id'))
                    ->preload()
                    ->suffixActions([
                        ActionsAction::make('reset')->icon('heroicon-o-trash')
                        ->action(fn (callable $set) => $set('type_id', null)),
                    ])
                    ->searchable(),
                Select::make('priority')->multiple()->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                    'urgent' => 'Urgent',
                ])->suffixActions([
                    ActionsAction::make('reset')->icon('heroicon-o-trash')
                    ->action(fn (callable $set) => $set('priority', null)),
                ]),
                ])


        ];
    }



    // public function filtersForm(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Section::make()
    //                 ->schema([
    //                     DatePicker::make('startDate')->prefix('Starts'),
    //                 ])
    //                 ->columns(3)

    //         ]);
    // }
}
