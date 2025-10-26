<?php

use App\Models\FileHandler;
use App\Models\GeneralSetting;
use App\Models\GoalAsset;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


if (!function_exists('getSettingData')) {
    function getSettingData($attr = null)
    {
        $settingsData = GeneralSetting::first();
        if ($attr) {
            if ($settingsData != null)
                return $settingsData->{$attr};
        }
        return $settingsData;
    }
}


if (!function_exists("permissionArrayList")) {
    function permissionArrayList()
    {
        $arr = [
            'dashboard',
            'users' => [
                'user-list',
                'role-permission',
            ],
            'goals',
            'policy',
            'services',
            'programmes',
            'events',
            'partnerships',
            'facilities',
            'research',
            'report',
            'news',
            'settings' => [
                'general-setting',
                'profile',
            ]
        ];
        return $arr;
    }
}

if (!function_exists("goalItemList")) {
    function goalItemList()
    {
        $arr = [
            'policy',
            'services',
            'programmes',
            'partnerships',
            'facilities',
            'events',
            'research',
            'report',
            'news',
        ];
        return $arr;
    }
}

if (!function_exists("setActive")) {
    function setActive($route)
    {
        return request()->routeIs($route) ? 'bg-white/20 text-white' : 'text-white hover:bg-white/10';
    }
}
