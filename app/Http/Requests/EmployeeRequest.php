<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
{
    return [
        'vendor_id'   => 'required|exists:vendors,id',
        'branch_id'   => 'nullable|exists:branches,id',
        'name'        => 'required|string|max:255',
        'position'    => 'nullable|string|max:255',
        'email'       => 'nullable|email|unique:employees,email,' . $this->route('employee'),
        'phone'       => 'nullable|string|unique:employees,phone,' . $this->route('employee'),
        'password'    => 'required|min:6',
        'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
}


    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'vendor_id.required'  => __('The vendor is required.'),
            'vendor_id.exists'    => __('The selected vendor is invalid.'),
            'branch_id.exists'    => __('The selected branch is invalid.'),
            'name.required'       => __('The employee name is required.'),
            'email.email'         => __('Please provide a valid email address.'),
            'email.unique'        => __('This email is already taken.'),
            'phone.unique'        => __('This phone number is already taken.'),
            'photo.image'         => __('The photo must be an image file.'),
            'photo.mimes'         => __('The photo must be a file of type: jpeg, png, jpg, gif.'),
            'photo.max'           => __('The photo size must not exceed 2MB.'),
            'password.required'  => __('The password is required.'),
            'password.min'       => __('The password must be at least 8 characters long.'),
            'password.confirmed' => __('The password confirmation does not match.'),

        ];
    }
}
