<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRestaurantSettingRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'email' => 'required|email',
            'address' => 'nullable|string',
            'phone' => 'nullable|regex:/^[0-9]{10,11}$/',
            'maps' => 'nullable|string',
            'status' => 'required',
            'logo' => 'required|image|max:2048',
        ];
    }

}
