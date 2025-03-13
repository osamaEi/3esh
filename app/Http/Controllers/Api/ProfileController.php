<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    /**
     * Update the authenticated user's profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'sometimes|required|string|min:8|confirmed',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            
            // Store new photo
            $path = $request->file('photo')->store('public/users');
            $validated['photo'] = str_replace('public/', '', $path);
        }
        
        // Hash password if provided
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        
        $user->update($validated);
        
        return (new UserResource($user))
            ->additional(['message' => 'Profile updated successfully']);
    }
}
