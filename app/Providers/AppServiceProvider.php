<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Ticket;
use App\Models\User;
use App\Policies\TicketPolicy;
use App\Policies\UserPolicy;
use App\Service\Post\ListPostService;
use App\Service\Post\PostFactories\PostFactory;
use App\Service\Post\PostInterfaces\PostInterface;
use App\View\AppLayout;
use App\View\Components\footer;
use App\View\Components\ListPost;
use App\View\GuestLayout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(PostInterface::class, ListPostService::class, PostFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Blade::component('layouts.app', AppLayout::class);
        Blade::component('layouts.guest', GuestLayout::class);
        Blade::component('components.list-post', ListPost::class);

        // spaite shield
        Gate::policy(Ticket::class, TicketPolicy::class);
        Gate::policy(User::class, UserPolicy::class);

   $smtp = smtp_setting();
    config([
            'mail.mailers.smtp.host' => $smtp['host'] ?? env('MAIL_HOST'),
            'mail.mailers.smtp.port' => $smtp['port'] ?? env('MAIL_PORT'),
            'mail.mailers.smtp.encryption' => $smtp['encryption'] ?? env('MAIL_ENCRYPTION'),
            'mail.mailers.smtp.username' => $smtp['username'] ?? env('MAIL_USERNAME'),
            'mail.mailers.smtp.password' => $smtp['password'] ?? env('MAIL_PASSWORD'),
            'mail.from.address' => $smtp['from_address'] ?? env('MAIL_FROM_ADDRESS'),
        ]);
    }
}
