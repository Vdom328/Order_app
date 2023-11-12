<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewOrderAdmin extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "restaurant_id" => "required",
            "table_id" => "required",
            "payment" => "required",
            "status" => "required",
            "order_food.*.food_id" => "required",
            "order_food.*.quantity" => "required",
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
            "restaurant_id.required" => "The restaurant ID is required.",
            "table_id.required" => "The table ID is required.",
            "payment.required" => "The payment is required.",
            "status.required" => "The status is required.",
            "order_food.*.food_id.required" => "The food ID is required for all order items.",
            "order_food.*.quantity.required" => "The quantity is required for all order items."
        ];
    }
}
