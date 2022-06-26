<?php

namespace Vidwan\Settings;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Vidwan\Settings\Models\Setting;
use Vidwan\Settings\Models\SettingGroup;

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
     * Render the Label HTML Element
     *
     * @param \Vidwan\Settings\Models\Setting $setting
     * @param array $attributes
     * @param $attributesFor
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public static function button(string $type, array $attributes = [], array $attributesFor = []): View|ViewFactory
    {
        return view('vidwanco-settings::button', [
            'type' => array_key_exists('type', $attributes) ? null : $type,
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
            'button' => $form->getButtonAttributes(),
            'buttonType' => $form->getButtonType(),
            'method' => $form->getMethod(),
            'action' => $form->getAction(),
            'uploadable' => $form->isUploadable(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request, SettingGroup $group): bool
    {
        $settings = $group->settings;

        $rules = collect([]);
        $messages = collect([]);
        $attributes = collect([]);

        foreach ($settings as $setting) {
            $type = $setting->input;
            $ruleType = [];

            if ($type === 'radio' or $type === 'select' or $type === 'checkbox') {
                $ruleType = Arr::prepend($ruleType, Rule::in($setting->optionKeys()));
            } elseif ($type === 'text' or $type === 'textarea') {
                $ruleType = Arr::prepend($ruleType, 'string');
                $ruleType = Arr::prepend($ruleType, 'nullable');
            } elseif ($type === 'email') {
                $ruleType = Arr::prepend($ruleType, 'email');
            } elseif ($type === 'password') {
                $ruleType = Arr::prepend($ruleType, 'confirmed');
            }

            $rules->put($setting->key, $ruleType);
            $attributes->put($setting->key, $setting->name);
        }

        $validator = Validator::make(
            $request->all(),
            $rules->toArray(),
            $messages->toArray(),
            $attributes->toArray()
        );

        if ($validator->fails()) {
            return throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        foreach ($validated as $key => $value) {
            $set = Setting::where('key', $key)->first();
            $set->value = $value;
            $set->save();
        }

        return true;
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
