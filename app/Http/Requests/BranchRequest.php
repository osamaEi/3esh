<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vendor_id'    => 'required|exists:vendors,id',
            'name'         => 'required|string|max:255',
            'address'      => 'required|string',
            'latitude'     => 'nullable|numeric',
            'longitude'    => 'nullable|numeric',
            'phone'        => 'nullable|string|max:30',
            'email'        => 'nullable|email',
            'manager_name' => 'nullable|string|max:255',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
            'is_approved'  => 'boolean',
            'is_active'    => 'boolean',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'working_days' => 'nullable|array',
            'working_days.*' => 'string',
            'notes'        => 'nullable|string',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'vendor_id.required'    => __('validation.branch_vendor_required'),
            'vendor_id.exists'      => __('validation.branch_vendor_exists'),
            'name.required'         => __('validation.branch_name_required'),
            'name.string'           => __('validation.branch_name_string'),
            'name.max'              => __('validation.branch_name_max'),
            'address.required'      => __('validation.branch_address_required'),
            'address.string'        => __('validation.branch_address_string'),
            'latitude.numeric'      => __('validation.branch_latitude_numeric'),
            'longitude.numeric'     => __('validation.branch_longitude_numeric'),
            'phone.string'          => __('validation.branch_phone_string'),
            'phone.max'             => __('validation.branch_phone_max'),
            'email.email'           => __('validation.branch_email_email'),
            'manager_name.string'   => __('validation.branch_manager_name_string'),
            'manager_name.max'      => __('validation.branch_manager_name_max'),
            'photo.image'           => __('validation.branch_photo_image'),
            'photo.mimes'           => __('validation.branch_photo_mimes'),
            'photo.max'             => __('validation.branch_photo_max'),
            'is_approved.boolean'   => __('validation.branch_is_approved_boolean'),
            'is_active.boolean'     => __('validation.branch_is_active_boolean'),
            'opening_time.date_format' => __('validation.branch_opening_time_format'),
            'closing_time.date_format' => __('validation.branch_closing_time_format'),
            'working_days.array'    => __('validation.branch_working_days_array'),
            'working_days.*.string' => __('validation.branch_working_days_string'),
            'notes.string'          => __('validation.branch_notes_string'),
        ];
    }
}
