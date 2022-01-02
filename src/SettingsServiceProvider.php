<?php

namespace Vidwanco\Settings;

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
        $this->publishes([
            __DIR__ . '/../config/settings.php' => config_path('settings.php')
        ], 'vidwanco-settings-config');
    }

    /**
     * Register Application Services
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Settings::class, function () {
            return new Settings();
        });
    }
}
