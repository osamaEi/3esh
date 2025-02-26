@props(['defaultTitle' => config('app.name')])

@php
    $siteTitle = \App\Models\Setting::where('key', 'site_title')->first();
    $title = $siteTitle ? $siteTitle->value : $defaultTitle;
@endphp

{{ $title }}