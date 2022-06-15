# Dynamic Settings with Form Builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vidwanco/settings.svg?style=flat-square)](https://packagist.org/packages/vidwanco/settings)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vidwanco/settings/run-tests?label=tests)](https://github.com/vidwanco/settings/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vidwanco/settings/Check%20&%20fix%20styling?label=code%20style)](https://github.com/vidwanco/settings/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/vidwanco/settings.svg?style=flat-square)](https://packagist.org/packages/vidwanco/settings)


A Package to generate Dynamic Settings with Simple Form Builder.

## Installation

You can install the package via composer:

```bash
composer require vidwanco/settings
```

## Usage

### FACADE

File: `Vidwan\Settings\Settings`

```php
use Vidwan\Settings\Settings;
...
Settings::form(Setting::all())
        ->labelAttributes(['class' => 'form-label'])
        ->inputAttributesFor('text', [
            'class' => 'form-control',
        ])
        ->inputAttributesFor('innerBlock', [
            'checkbox' => [
                'class' => 'form-control',
            ],
        ])
        ->inputAttributesFor('checkbox', function ($settings) {
            return [
                'class' => 'form-check',
            ];
        })
        ->formAttributes(['id' => 'settings-form'])
        ->blockAttributes(['class' => 'mb-1'])
        ->uploadable()
        ->render();
```

### Helper

```php
    settings('theme');
```

### Ignoring Migration

Ignoring auto-migrations (without publishing) and specifying the path to publish migrations.

```php

use Vidwan\Settings\Settings;

...

class AppServiceProvider extends ServiceProvider
{
    ...

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Disable auto-migration
        Settings::$runsMigrations = false;
        // Sets Migration Path
        Settings::$migrationPath = database_path('migrations/tenant');
    }

    ...

}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Support us

You can support us by contributing to our open source projects or Sponsoring the projects you use.

## Credits

- [Shashwat Mishra](https://github.com/vidwanco)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
