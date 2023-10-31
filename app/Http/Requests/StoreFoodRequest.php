<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoodRequest extends FormRequest
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
            'name' => ['bail','required','string','between:3,20','unique:food'],
            'materials' => ['nullable'],
            'price' => ['bail','required','numeric','min:10000'],
            'food_tire_id' => ['bail','required','numeric','exists:food_tires,id'],
            'restaurant_id'=>['bail','required','numeric','exists:restaurants,id']
        ];
    }
}
