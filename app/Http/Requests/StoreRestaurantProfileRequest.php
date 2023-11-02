<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRestaurantProfileRequest extends FormRequest
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
            'name' => ['bail','required','string','between:3,20'],
            'phone' =>  ['bail','required','string'],
            'address' => ['bail','required','string','between:3,200'],
            'account' => ['bail','required','string',],
            'opens_at' => ['bail','nullable','string'],
            'closes_at' => ['bail','nullable','string'],
            'tiers' => ['required','array']
        ];
    }
}
