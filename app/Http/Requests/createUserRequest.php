<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createUserRequest extends FormRequest
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
            'account_status' => 'required|string',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_pass' => 'required|same:password',
            'address' => 'nullable|string',
            'telephone' => 'nullable|numeric',
            'gender' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'account_status.required' => 'The Account status field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'confirm_pass.required' => 'The confirm pass field is required.',
            'confirm_pass.same' => 'confirm password must be the same as password.',
            'password.min' => 'The password must be at least 6 characters.',
            'telephone.numeric' => 'The phone number must be numeric.',
        ];
    }
}
