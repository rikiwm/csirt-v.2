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
use App\Filament\Pages\SummaryReport;
use App\Filament\Pages\SummaryReports;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Pboivin\FilamentPeek\FilamentPeekPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Pages\Auth\EmailVerification\EmailVerificationPrompt;
use Filament\Pages\Auth\PasswordReset\RequestPasswordReset;

use Filament\FontProviders\GoogleFontProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->font('Noto Sans')
            ->default()
            ->favicon(asset('frontend/img/cslogo.png'))
            ->id('admin')
            ->path('app')
            ->login()
            ->emailVerification(EmailVerificationPrompt::class)
            ->passwordReset()
            ->registration(Register::class)
            ->spa(false)
            ->databaseNotifications()
            ->plugins([
                FilamentPeekPlugin::make(),
                FilamentShieldPlugin::make(),
            ])
            ->colors([
                'urgent' => Color::Red,
                'danger' => Color::Pink,
                'gray' => Color::Zinc,
                'info' => Color::rgb('rgb(214, 107, 143)'),
                'primary' =>  Color::rgb('rgb(13, 168, 224)'),
                'secondary' => Color::rgb('rgb(199, 171, 47)'),

            ])
            ->profile(isSimple: false, page: Profile::class)
            ->maxContentWidth(MaxWidth::ScreenTwoExtraLarge)
            ->brandLogo(asset('frontend/cslgo.png'))
            ->brandLogoHeight('2rem')
            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            // ->topNavigation()
            // ->topbar(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
                SummaryReport::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                \App\Filament\Widgets\TicketChart::class,
                \App\Filament\Widgets\ChartTiket::class,
                \App\Filament\Widgets\TicketChartLine::class,
                \App\Filament\Widgets\TicketCount::class,
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
