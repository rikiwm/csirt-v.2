<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\TicketChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
// use Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Profile;
use App\Filament\Pages\Auth\Register;
use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\TicketCount;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Pboivin\FilamentPeek\FilamentPeekPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Pages\Auth\EmailVerification\EmailVerificationPrompt;
use Filament\Pages\Auth\PasswordReset\RequestPasswordReset;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('app')
            ->login()
            ->registration(Register::class)
            ->emailVerification()
            ->passwordReset()
            ->spa()
            ->databaseNotifications()
            ->plugins([
                FilamentPeekPlugin::make(),
                FilamentShieldPlugin::make(),
            ])
            ->colors([
                'urgent' => Color::Purple,
                'danger' => Color::Rose,
                // 'gray' => Color::Zinc,
                // 'gray' => '#111111',
                'info' => Color::Sky,
                'primary' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Yellow,
            ])
            ->profile(isSimple: false, page: Profile::class)
            ->maxContentWidth(MaxWidth::Full)
            ->brandName('KOMDIGI ')
            // ->brandLogo(asset('https://csirt.padang.go.id/storage/image-property/fKyvMUuQq843IVHaaiXuh8Lum2tdRc3xYJrJ7Bzh.png'))
            // ->brandLogoHeight('2rem')
            ->sidebarCollapsibleOnDesktop()
            ->topNavigation()
            ->topbar(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                TicketChart::class,
                TicketCount::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
