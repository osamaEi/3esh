<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function adminLoginView() {

        return view('admin.auth.login');


    }


    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Attempt to log the user in using the admin guard
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Redirect to admin dashboard after successful login
            return redirect()->intended(route('admin.dashboard'));
        }
        
        // Authentication failed 
        return back()->withErrors([ 
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
}

