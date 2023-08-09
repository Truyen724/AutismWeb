<?php

if (!function_exists('getLanguageCode')) {
    function getLanguageCode($code)
    {
        $languages = ['vi' => 'vi-VN', 'en' => 'en-US', 'fr' => 'fr-FR', 'es' => 'es-ES'];
        return $languages[$code];
    }
}

if (!function_exists('getTotalDays')) {
    function getTotalDays($value)
    {
        $days = [1 => [1, 3], 2 => [4, 7], 3 => [8, 14], 4 => [14, 100]];
        return $days[$value];
    }
}

if (!defined('PAGE_SIZE_CLIENT')) {
    define('PAGE_SIZE_CLIENT', '8');
}

if (!defined('PAGE_SIZE_ADMIN')) {
    define('PAGE_SIZE_ADMIN', '10');
}

if (!defined('SUPER_ADMIN_ID')) {
    define('SUPER_ADMIN_ID', '0000000000');
}

if (!defined('VI_CODE')) {
    define('VI_CODE', 'vi');
}

if (!defined('EN_CODE')) {
    define('EN_CODE', 'en');
}

if (!defined('FR_CODE')) {
    define('FR_CODE', 'fr');
}

if (!defined('ES_CODE')) {
    define('ES_CODE', 'es');
}

if (!defined('STATUS_UNACTIVE')) {
    define('STATUS_UNACTIVE', 0);
}

if (!defined('STATUS_ACTIVE')) {
    define('STATUS_ACTIVE', 1);
}

if (!defined('FILE_PICTURE_PATH')) {
    define('FILE_PICTURE_PATH', 'picture');
}
