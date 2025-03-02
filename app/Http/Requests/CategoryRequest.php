<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|exists:categories,id',
            'is_active'   => 'boolean',
            'level_id'    => 'integer',
            'photo'       => 'nullable',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required'        => __('validation.category_name_required'),
            'name.string'          => __('validation.category_name_string'),
            'name.max'             => __('validation.category_name_max'),
            'description.string'   => __('validation.category_description_string'),
            'parent_id.exists'     => __('validation.category_parent_id_exists'),
            'is_active.boolean'    => __('validation.category_is_active_boolean'),
            'level_id.integer'     => __('validation.category_level_id_integer'),
            'photo.nullable'       => __('validation.category_photo_nullable'),
        ];
    }
}
