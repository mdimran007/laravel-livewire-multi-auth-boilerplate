<?php

use App\Models\FileHandler;
use App\Models\GeneralSetting;
use App\Models\GoalAsset;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

if (!function_exists("getSetting")) {
    function getSetting($option, $default = NULL)
    {
        $system_settings = config('settings');

        if ($option && isset($system_settings[$option])) {
            return $system_settings[$option];
        } else {
            return $default;
        }
    }
}


if (!function_exists('getSettingData')) {
    function getSettingData($attr = null)
    {
        $settingsData = GeneralSetting::first();
        if($attr){
            if($settingsData != null)
            return $settingsData->{$attr};
        }
        return $settingsData;
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


if (!function_exists("goalAssetsProperty")) {
    function goalAssetsProperty()
    {
        // if you add new asset then need to check here any new field , if new then need to work form modal,validation,details modal.
        //  now only support [ 'title',
        //         'short_description',
        //         'description',
        //         'url',
        //         'image',
        //  'event_date'];

        $arr = [
            'policy' => [
                'title',
                'short_description',
                'description',
                'url',
                'image',
            ],
            'services' => [
                'title',
                'short_description',
                'description',
                'url',
                'image',
            ],
            'programmes' => [
                'title',
                'short_description',
                'description',
                'url',
                'image',
            ],
            'partnerships' => [
                'title',
                'short_description',
                'url',
                'image',
            ],
            'facilities' => [
                'title',
                'short_description',
                'description',
                'url',
                'image',
            ],
            'events' => [
                'title',
                'short_description',
                'description',
                'url',
                'image',
                'event_date'
            ],
            'research' => [
                'title',
                'short_description',
                'description',
                'url',
                'image',
            ],
            'report' => [
                'title',
                'short_description',
                'description',
                'url',
                'image',
            ],
            'news' => [
                'title',
                'short_description',
                'description',
                'url',
                'image',
            ],

        ];
        return $arr;
    }
}


function goalAssetCount($assetType)
{
    return GoalAsset::where('asset_type', $assetType)->count();
}


function goalAssetCounts()
{
    $types = goalAssetsProperty(); // your predefined array
    $counts = [];

    foreach ($types as $type => $fields) {
        $counts[$type] = GoalAsset::where('asset_type', $type)->count();
    }

    return $counts;
}
