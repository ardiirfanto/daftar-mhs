<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Provider utama aplikasi untuk mendaftarkan dan melakukan bootstrap service.
     *
     * @package App\Providers
     */
    /**
     * Mendaftarkan service aplikasi.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Melakukan bootstrap service aplikasi.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
