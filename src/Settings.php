<?php

namespace Vidwan\Settings;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\ComponentAttributeBag;
use Vidwan\Settings\Models\Setting;
use Illuminate\Support\Str;

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

    /**
     * Indicates the Available Components
     *
     * @var array
     */
    protected static array $uiComponents = [
        'text',
        'textarea',
        'checkbox',
        'radio',
        // 'email', // TODO
        // 'password', // TODO
    ];

    /**
     * Render the Input HTML Element
     *
     * @param \Vidwan\Settings\Models\Setting $setting
     * @param array $attributes
     * @param $attributesFor
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public static function input(Setting $setting, array $attributes = [], array $attributesFor = []): View|ViewFactory
    {
        $type = self::$type;

        if (self::checkComponent($setting->input)) {
            $type = $setting->input;
        }

        return view("vidwanco-settings::{$type}", [
            'type' => $type,
            'id' => array_key_exists('id', $attributes) ? null : Str::camel($setting->name),
            'setting' => $setting,
            'attributes' => $attributes,
            'attributesFor' => $attributesFor,
        ]);
    }

    /**
     * Render the Label HTML Element
     *
     * @param \Vidwan\Settings\Models\Setting $setting
     * @param array $attributes
     * @param $attributesFor
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public static function label(Setting $setting, array $attributes = [], array $attributesFor = []): View|ViewFactory
    {
        return view('vidwanco-settings::label', [
            'setting' => $setting,
            'for' => array_key_exists('for', $attributes) ? null : Str::camel($setting->name),
            'attributes' => $attributes,
            'attributesFor' => $attributesFor,
        ]);
    }

    /**
     * Creates a Form Object
     *
     * @param \Illuminate\Database\Eloquent\Collection $collection
     * @return \Vidwan\Settings\Form
     */
    public static function form(Collection $settings): Form
    {
        return new Form($settings);
    }

    /**
     * Render the HTML Form
     *
     * @param \Illuminate\Database\Eloquent\Collection $collection
     * @param \Vidwan\Settings\Form $form
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public static function formRender(Collection $settings, Form $form): View|ViewFactory
    {
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

    /**
     * Checks if Component exists
     *
     * @param string $component
     * @return bool
     */
    public static function checkComponent(string $component): bool
    {
        return in_array($component, self::$uiComponents);
    }
}
