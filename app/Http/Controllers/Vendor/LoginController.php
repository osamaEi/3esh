<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function VendorLoginView() {

        return view('vendors.employees.auth.login'); 

    }


    public function vendorLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Attempt to log the user in using the admin guard
        if (Auth::guard('employee')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            
            return redirect()->intended(route('vendors.dashboard'));
        }
        
        // Authentication failed 
        return back()->withErrors([ 
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    public function vendorLogout(Request $request)
    {
        Auth::guard('employee')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect()->route('vendors.login');
    }
}
