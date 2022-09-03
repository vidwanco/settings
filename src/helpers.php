<?php

use Illuminate\Support\Facades\Cache;
use Vidwan\Settings\Models\Setting;

if (! function_exists('settings')) {
    function settings($key = null, $default = null)
    {
        if ($key) {
            $setting = Cache::tags(['vidwanco-settings'])->remember(
                "vidwanco-settings-{$key}",
                60 * 60 * 24,
                fn () => Setting::where('key', $key)->first()
            );

            return $setting ? $setting->default : $default;
        }

        return $default;
    }
}
