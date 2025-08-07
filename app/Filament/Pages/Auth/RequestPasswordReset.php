<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;

class RequestPasswordReset extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.auth.request-password-reset';
}
