<?php

use App\Models\FileHandler;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

if (!function_exists("getSetting")) {
    function getSetting($option, $default = NULL){
        $system_settings = config('settings');

        if ($option && isset($system_settings[$option])) {
            return $system_settings[$option];
        } else {
            return $default;
        }
    }
}


if (!function_exists('getTimeZone')) {
    function getTimeZone(){
        return DateTimeZone::listIdentifiers(
            DateTimeZone::ALL
        );
    }
}

if (!function_exists('getImageUrl')) {
    function getImageUrl($id = null, $demo_image_type = null, $demo_image_dimension = null){
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
    function getFileProperty($id, $property){
        $file = FileHandler::find($id);
        $respose = null;
        if (!is_null($file)) {
            return $file->{$property};
        }
        return $respose;
    }
}

if (!function_exists('getStatusHtml')) {
    function getStatusHtml($status){
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
    function getUserData($id){
        $user = User::find($id);
        if (!is_null($user)) {
            return $user;
        }
        return null;
    }
}

if (!function_exists("goalItemList")) {
    function goalItemList() {
        $arr = [
            'policy',
            'services',
            'programmes',
            'events',
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
