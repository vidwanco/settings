<?php

namespace Vidwanco\Settings\Tests;

use Vidwanco\Settings\SettingsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the Test Case
     *
     * @return void
    */
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    /**
     * Register Service Providers
     *
     * @param $app undefined
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            SettingsServiceProvider::class,
        ];
    }

    /**
     * Perform Environment Setup
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        // void
    }
}
