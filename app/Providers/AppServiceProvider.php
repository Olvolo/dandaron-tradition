<?php

namespace App\Providers;

use App\View\Composers\MainMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Передаём массив, чтобы Composer работал и для шапки, и для подвала
        View::composer(
            ['layouts.partials.header', 'layouts.partials.footer'],
            MainMenuComposer::class
        );
    }
}
