@props(['defaultFaviconPath' => 'assets/media/logos/favicon.ico'])

@php
    use Illuminate\Support\Str;
    
    // Get favicon from settings
    $favicon = \App\Models\Setting::where('key', 'favicon')->first();
    
    // Determine the favicon path
    if ($favicon) {
        if (Str::startsWith($favicon->value, 'image:')) {
            $faviconPath = asset('storage/' . Str::after($favicon->value, 'image:'));
        } else {
            $faviconPath = $favicon->value;
        }
    } else {
        // Check if logo exists and use that as fallback
        $logo = \App\Models\Setting::where('key', 'logo')->first();
        if ($logo && Str::startsWith($logo->value, 'image:')) {
            $faviconPath = asset('storage/' . Str::after($logo->value, 'image:'));
        } else if ($logo) {
            $faviconPath = $logo->value;
        } else {
            $faviconPath = asset($defaultFaviconPath);
        }
    }
@endphp

<link rel="shortcut icon" href="{{ $faviconPath }}"/>