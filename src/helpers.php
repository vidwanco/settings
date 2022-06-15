<?php

use Vidwan\Settings\Models\Setting;

if (! function_exists('settings')) {
    function settings($key = null, $default = null)
    {
        if (tenant()) {
            if ($key) {
                $setting = Setting::where('key', $key)->first();

                return $setting ? $setting->value : $default;
            }

            return Setting::all();
        }

        return $default;
    }
}
