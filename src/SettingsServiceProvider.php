<?php

namespace Vidwan\Settings;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'vidwanco-settings');

        if ($this->app->runningInConsole()) {

            $this->setMigrationPath();

            $this->publishes([
                __DIR__ . '/../config/settings.php' => config_path('settings.php'),
            ], 'vidwan-settings-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => Settings::$migrationPath,
            ], 'vidwan-settings-migrations');

            $this->registerMigrations();

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/settings'),
            ], 'vidwan-settings-views');

        }

    }

    /**
     * Register Setting's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if (Settings::$runsMigrations) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    /**
     * Set Migration Path
     *
     * @return void
     */
    protected function setMigrationPath()
    {
        if (empty(Settings::$migrationPath))
        {
            Settings::$migrationPath = config('settings.migration_path', database_path('migrations'));
        }
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
