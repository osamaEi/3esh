<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request, $locale)
    {
        // Validate locale
        $allowedLocales = ['ar', 'en'];
        if (in_array($locale, $allowedLocales)) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
