<?php

use App\Models\FileHandler;
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


if (!function_exists('getTimeZone')) {
    function getTimeZone()
    {
        return DateTimeZone::listIdentifiers(
            DateTimeZone::ALL
        );
    }
}

if (!function_exists('getImageUrl')) {
    function getImageUrl($id = null, $demo_image_type = null, $demo_image_dimension = null)
    {
        $file = FileHandler::select('path', 'storage_type')->find($id);
        if (!is_null($file)) {
            if (Storage::disk($file->storage_type)->exists($file->path)) {
                if ($file->storage_type == 'public' || $file->storage_type == 'local') {
                    return asset('storage/' . $file->path);
                }
                if ($file->storage_type == 'wasabi') {
                    return Storage::disk('wasabi')->url($file->path);
                }
                return Storage::disk($file->storage_type)->url($file->path);
            }
        }

        $demoImgSize = '';
        if ($demo_image_dimension != null) {
            $demoImgSize = '-d-' . $demo_image_dimension;
        }

        return asset('assets/images/no-image' . $demoImgSize . '.jpg');
    }
}


if (!function_exists('getFileProperty')) {
    function getFileProperty($id, $property)
    {
        $file = FileHandler::find($id);
        $respose = null;
        if (!is_null($file)) {
            return $file->{$property};
        }
        return $respose;
    }
}

if (!function_exists('getStatusHtml')) {
    function getStatusHtml($status)
    {
        $html = '';
        if ($status == STATUS_ACTIVE) {
            $html = '<p class="zBadge zBadge-active">' . __("Active") . '</p>';
        } else {
            $html = '<p class="zBadge zBadge-deactivate">' . __("Deactivate") . '</p>';
        }
        return $html;
    }
}


if (!function_exists('getUserData')) {
    function getUserData($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            return $user;
        }
        return null;
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

if (!function_exists('encoder')) {
    function encoder($id)
    {
        return base64_encode($id);  // simple encoding
    }
}

if (!function_exists('decoder')) {
    function decoder($encodedId)
    {
        return base64_decode($encodedId);  // decode
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
