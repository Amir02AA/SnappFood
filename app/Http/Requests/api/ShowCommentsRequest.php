<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class ShowCommentsRequest extends FormRequest
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
            'food_id' => ['required_without:restaurant_id','prohibits:restaurant_id', 'nullable', 'exists:food,id'],
            'restaurant_id' => ['required_without:food_id','prohibits:food_id', 'nullable', 'exists:restaurants,id'],
        ];
    }

}
