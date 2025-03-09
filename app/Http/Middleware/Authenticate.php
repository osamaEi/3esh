<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Check which guard is being used
            if (str_starts_with($request->path(), 'admin')) {
                return route('admin.login');
            } elseif (str_starts_with($request->path(), 'employee')) {
                return route('vendors.login');
            }
            
            // Fallback to default login route if you have one
            return '/login';
        }
        
        return null;
    }
}