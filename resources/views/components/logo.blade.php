@props([
    'linkUrl' => route('admin.dashboard', [], false),
    'height' => '50px',
    'class' => '',
    'defaultLogoPath' => 'assets/media/logos/default-logo.png'
])

@php
    use Illuminate\Support\Str;
    
    // Get logo from settings
    $logo = \App\Models\Setting::where('key', 'logo')->first();
    
    // Determine the logo path
    if ($logo) {
        if (Str::startsWith($logo->value, 'image:')) {
            $logoPath = asset('storage/' . Str::after($logo->value, 'image:'));
        } else {
            $logoPath = $logo->value;
        }
    } else {
        $logoPath = asset($defaultLogoPath);
    }
    
    // Calculate CSS classes
    $imgClasses = 'app-sidebar-logo-default';
    if (!empty($class)) {
        $imgClasses .= ' ' . $class;
    }
    
    // Set image height
    $imgStyle = "height: $height";
@endphp

<a href="{{ $linkUrl }}">
    <img alt="Logo" src="{{ $logoPath }}" class="{{ $imgClasses }}" style="{{ $imgStyle }}" />
</a>