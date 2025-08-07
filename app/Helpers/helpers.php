<?php


if (!function_exists('smtp_setting')) {
    function smtp_setting($key = null, $default = null)
    {
        $data = \App\Models\SettingWeb::where('key', 'smtp')->value('value');


        if ($key) {
            return $data[$key] ?? $default;
        }

        return $data;
    }
}

