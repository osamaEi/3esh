<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index() {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function create() {
        return view('admin.settings.create');
    }

    public function store(Request $request) {
        $request->validate([
            'key' => 'required|unique:settings',
            'value' => 'nullable',
            'image_value' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $data = $request->only(['key']);
        
        if ($request->value_type === 'image' && $request->hasFile('image_value')) {
            $imagePath = $request->file('image_value')->store('settings', 'public');
            $data['value'] = 'image:' . $imagePath;
        } else {
            $data['value'] = $request->value;
        }
        
        Setting::create($data);
        return redirect()->route('settings.index')->with('success', __('Setting created.'));
    }
    
    public function edit($id) {
        $setting = Setting::findOrFail($id);
        return view('admin.settings.edit', compact('setting'));
    }


    public function update(Request $request, $id) {
        $setting = Setting::findOrFail($id);
        $request->validate([
            'key' => 'required|unique:settings,key,'.$id,
            'value' => 'nullable',
            'image_value' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $data = $request->only(['key']);
        
        if ($request->value_type === 'image') {
            if ($request->hasFile('image_value')) {
                // Delete old image if it exists
                if (Str::startsWith($setting->value, 'image:')) {
                    $oldImagePath = Str::after($setting->value, 'image:');
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
                
                // Upload new image
                $imagePath = $request->file('image_value')->store('settings', 'public');
                $data['value'] = 'image:' . $imagePath;
            } else {
                // Keep existing image
                $data['value'] = $setting->value;
            }
        } else {
            // Text value
            $data['value'] = $request->value;
            
            // If changing from image to text, delete the old image
            if (Str::startsWith($setting->value, 'image:')) {
                $oldImagePath = Str::after($setting->value, 'image:');
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }
        }
        
        $setting->update($data);
        return redirect()->route('settings.index')->with('success', __('Setting updated.'));
    }

    public function destroy($id) {
        $setting = Setting::findOrFail($id);
        $setting->delete();
        return redirect()->route('settings.index')->with('success', __('Setting deleted.'));
    }
}
