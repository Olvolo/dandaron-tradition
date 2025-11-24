<?php

namespace App\Providers;

use App\View\Composers\MainMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Применяем MainMenuComposer ко всем view, которые используют layout
        View::composer([
            'components.layout',
            'layouts.app',
            'home',
            'pages.*'
        ], MainMenuComposer::class);
    }
}
