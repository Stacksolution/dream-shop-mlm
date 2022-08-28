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
        if($image_path != null){
            if(File::exists(public_path('uploads/'.$image_path))){ 
                $image = static_asset('uploads/'.$image_path);
            }  
        }
        return $image;
    }
}

if (!function_exists('number_formats')) {
    function number_formats($number = null){
        if(empty($number)){
            return 'Rs. 0';
        }
        return 'Rs. '.number_format($number,2,".",",");
    }
}