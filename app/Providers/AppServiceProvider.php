<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // 1. WAJIB TAMBAHKAN BARIS INI

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
        // 2. TAMBAHKAN KODE INI AGAR CSS TIDAK DIBLOKIR BROWSER
        if (str_contains(env('APP_URL'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}