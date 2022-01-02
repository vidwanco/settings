<?php

namespace Vidwanco\Settings;

use Vidwanco\Settings\Settings;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services for Application
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register Application Services
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Settings::class, function() {
            return new Settings();
        });
    }

}
