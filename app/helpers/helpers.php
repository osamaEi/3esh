<?php

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route, $output = 'active')
    {
        if (request()->routeIs($route)) {
            return $output;
        }
        return '';
    }
}
?>