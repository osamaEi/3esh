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
            'business_name'  => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:vendors,email',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories'     => 'nullable|array',
            'categories.*'   => 'exists:categories,id',
            'contact_person' => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages()
    {
        return [
            'business_name.required'  => __('validation.vendor_business_name_required'),
            'business_name.string'    => __('validation.vendor_business_name_string'),
            'business_name.max'       => __('validation.vendor_business_name_max'),
            'email.required'          => __('validation.vendor_email_required'),
            'email.string'            => __('validation.vendor_email_string'),
            'email.email'             => __('validation.vendor_email_valid'),
            'email.max'               => __('validation.vendor_email_max'),
            'email.unique'            => __('validation.vendor_email_unique'),
            'logo.image'              => __('validation.vendor_logo_image'),
            'logo.mimes'              => __('validation.vendor_logo_mimes'),
            'logo.max'                => __('validation.vendor_logo_max'),
            'categories.array'        => __('validation.vendor_categories_array'),
            'categories.*.exists'     => __('validation.vendor_categories_valid'),
            'contact_person.string'   => __('validation.vendor_contact_person_string'),
            'contact_person.max'      => __('validation.vendor_contact_person_max'),
        ];
    }
}
