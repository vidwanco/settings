<?php

use Vidwan\Settings\Models\Setting;

if (! function_exists('settings')) {
    function settings($key = null, $default = null)
    {
        if ($key) {
            $setting = Setting::where('key', $key)->first();

            return $setting ? $setting->default : $default;
        }

        return $default;
    }
}
