<?php
if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if (!function_exists('createSlug')) {
    function createSlug($str)
    {
        $str = mb_strtolower($str);
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/([^0-9a-z-\s])/', '', $str);
        $str = preg_replace('/(\s+)/', '-', $str);
        $str = preg_replace('/-+/', '-', $str);
        $str = preg_replace('/^-+/', '', $str);
        $str = preg_replace('/-+$/', '', $str);
        return $str;
    }
}

if (!function_exists('convertSizeB2MB')) {
    function convertSizeB2MB($size)
    {
        return $size / 1048576;
    }
}
if (!function_exists('getImagePath')) {
    function getImagePath($fullPath)
    {
        return parse_url($fullPath, PHP_URL_PATH);
    }
}
if (!function_exists('checkUrl')) {
    function checkUrl($url)
    {
        return preg_match('/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/', $url);
    }
}
if (!function_exists('comparator')) {
    function comparator($object1, $object2)
    {
        return $object1->count < $object2->count;
    }
}
if (!function_exists('findElementByKeyValue')) {
    function findElementByKeyValue($key, $value, $array)
    {
        foreach ($array as $element) {
            if ($value == $element->{$key}) {
                return $element;
            }
        }

        return false;
    }
}
if (!function_exists('returnStringValueByKey')) {
    function returnStringValueByKey($key, $array)
    {
        $string = '';
        if ($array != null) {
            $countArray = count($array);

            for ($i = 0; $i < $countArray; $i++) {
                $string .= $array[$i]->{$key};
                if ($i < $countArray - 1)
                    $string .= ',';
            }
        }
        return $string;
    }
}
if (!function_exists('is_valid_domain_name')) {
    function is_valid_domain_name($domain_name)
    {
        return filter_var($domain_name, FILTER_VALIDATE_URL);
    }
}
if (!function_exists('activeMenu')) {
    function activeMenu($uri = '')
    {
        $active = '';
        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'is-active';
        }
        return $active;
    }
}