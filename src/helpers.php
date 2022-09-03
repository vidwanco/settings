<?php

use Vidwan\Settings\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('settings')) {
    function settings($key = null, $default = null)
    {
        if ($key) {
            $setting = Cache::tags(['vidwanco-settings'])->remember(
                "vidwanco-settings-{$key}",
                60*60*24,
                fn() => Setting::where('key', $key)->first()
            );

            return $setting ? $setting->default : $default;
        }

        return $default;
    }
}
