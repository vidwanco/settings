# Dynamic Settings with Form Builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vidwan/settings.svg?style=flat-square)](https://packagist.org/packages/vidwan/settings)
[![GitHub Tests Action Status](https://github.com/vidwanco/settings/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/vidwanco/settings/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://github.com/vidwanco/settings/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/vidwanco/settings/actions/workflows/php-cs-fixer.yml)
[![Psalm](https://github.com/vidwanco/settings/actions/workflows/psalm.yml/badge.svg)](https://github.com/vidwanco/settings/actions/workflows/psalm.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/vidwan/settings.svg?style=flat-square)](https://packagist.org/packages/vidwan/settings)


A Package to generate Dynamic Settings with a Simple Form Builder.

## Installation

You can install the package via composer:

```bash
composer require vidwan/settings
```

## Usage

### Form Builder

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

### Single Label & Input Builder

```php
use Vidwan\Settings\Models\Setting;

$settings = Setting::all();

foreach ($settings as $setting)
{
    $setting->formLabel(attributes: ['class' => 'something']); // <label></label>
    $setting->formInput(attributes: ['class' => 'form-control']); // <input />
}
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

- [Shashwat Mishra](https://github.com/secrethash)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
