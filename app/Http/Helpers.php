<?php

use Carbon\Carbon;

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}

if (!function_exists('canvert_date')) {
    /**
     * Change date format in application.
     *
     * @param string $date
     * @param String|null $format
     * @return string date
     */
    function canvert_date($date)
    {   $date_format  = 'd M Y'; 
        $canvert_date = date($date_format,strtotime($date));
        return $canvert_date;
    }
}

if (!function_exists('canvert_strtotime_time')) {
    /**
     * canvert time strtotime
     *
     * @param time $time
     * @param String|null $date_format
     * @return string date
     */
    function canvert_strtotime_time($time,$date_format = 'H:i A'){
        $canvert_time = date($date_format,$time);
        return $canvert_time;
    }
}

if (!function_exists('image_path')) {
    /**
     * check image exist or not on directory 
     * if not exist then return plasholder
     * @param String|$image_path
     * @param String|null $file url
     * @return string url
     */
    function image_path($image_path = null){
        $image = static_asset('back-end/images/users/avatar-1.jpg');
        if($image_path != null && is_string($image_path)){
            if(File::exists(public_path('uploads/'.$image_path))){ 
                $image = static_asset('uploads/'.$image_path);
            }  
        }else if(!is_string($image_path) && is_numeric($image_path)){
            if (($asset = \App\Models\Upload::find($image_path)) != null) {
                $image =  $asset->external_link == null ? my_asset($asset->file_name) : $asset->external_link;
            }
        }
        return $image;
    }
}

if (!function_exists('compare_values')) {
    function compare_values($wallet,$points){
        $wallet_array = array();
        for($i = 0 ; $i < $wallet; $i+= 0.01){
            array_push($wallet_array,$i);
        }

        $points_array = array();
        for($j = 0 ; $j < $points; $j+= 0.01){
            array_push($points_array,$j);
        }
        $diffvalue = array_diff($wallet_array,$points_array);
        $count  = count($diffvalue) - count($wallet_array);

        return (abs($count) / 100);
    }
}


if (!function_exists('number_formats')) {
    function number_formats($number = null){
        if(empty($number)){
            return '0';
        }
        return number_format($number,2,".",",");
    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = '//' . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}

if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return env('AWS_URL') . '/';
        } else {
            return getBaseURL() . 'public/';
        }
    }
}

if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($path);
        } else {
            return app('url')->asset('public/' . $path, $secure);
        }
    }
}

if (!function_exists('char_limit')) {
    function char_limit($string, $limit = 5)
    {
        return mb_strimwidth($string, 0, $limit, "...");
    }
}

