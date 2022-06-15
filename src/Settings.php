<?php

namespace Vidwan\Settings;

use Vidwan\Settings\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\ComponentAttributeBag;

class Settings
{

    public static $method = 'PUT';

    public static $type = 'input';

    /**
     * Indicates if Settings migrations will be run.
     *
     * @var bool
     */
    public static bool $runsMigrations = true;

    /**
     * Indicates the path where migrations will be published
     *
     * @var string
     */
    public static string $migrationPath;

    protected static array $uiComponents = [
        'input',
        'text',
        'textarea',
        'email',
        'password',
        'checkbox',
        'radio',
    ];

    public static function input(Setting $setting, array $attributes = [], array $attributesFor = []): View
    {
        $type = self::$type;

        if (self::checkComponent($setting->input))
        {
            $type = $setting->input;
        }

        return view("vidwanco-settings::{$type}", [
            'type' => $type,
            'id' => array_key_exists('id', $attributes) ? null : str()->camel($setting->name),
            'setting' => $setting,
            'attributes' => $attributes,
            'attributesFor' => $attributesFor,
        ]);
    }

    public static function label(Setting $setting, array $attributes = [], array $attributesFor = []): View
    {
        return view('vidwanco-settings::label', [
            'setting' => $setting,
            'for' => array_key_exists('for', $attributes) ? null : str()->camel($setting->name),
            'attributes' => $attributes,
            'attributesFor' => $attributesFor,
        ]);
    }

    public static function form(Collection $settings): Form
    {
        return new Form($settings);
    }

    public static function formRender(Collection $settings, Form $form): View
    {
        // $attributes = new ComponentAttributeBag($attributes);
        return view('vidwanco-settings::form', [
            'settings' => $settings,
            'form' => $form->getFormAttributes(),
            'label' => $form->getLabelAttributes(),
            'input' => $form->getInputAttributes(),
            'attributesFor' => $form->getAttributesFor(),
            'block' => $form->getBlockAttributes(),
            'method' => $form->getMethod(),
            'action' => $form->getAction(),
            'uploadable' => $form->isUploadable(),
        ]);
    }

    public static function checkComponent(string $component): bool
    {
        return in_array($component, self::$uiComponents);
    }
}
