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

if (!function_exists('isActiveRouteVendor')) {
    function isActiveRouteVendor($routeName) {
        return request()->routeIs($routeName) ? 'bg-purple-500 text-white' : '';
    }
}
?>