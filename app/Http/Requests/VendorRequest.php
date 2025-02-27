<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'business_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:vendors,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate logo file
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id', // Validate category IDs
            'contact_person' => 'nullable|string|max:255',
        ];
    }
}
