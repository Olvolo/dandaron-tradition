<?php

namespace App\Providers;

use App\View\Composers\MainMenuComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Регистрируем view composer после загрузки приложения
        $this->app->booted(function () {
            view()->composer(
                ['layouts.partials.header', 'layouts.partials.footer'],
                MainMenuComposer::class
            );
        });
    }
}
