<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;


class TicketReward extends Page
{
   protected static bool $shouldRegisterNavigation = false;

    // use  HasFiltersAction, HasFiltersForm;
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    //  public function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             TextInput::make('mail_host')->label('SMTP Host')->required(),
    //         ])
    //         ->statePath('data');
    // }

}
