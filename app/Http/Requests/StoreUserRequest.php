<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['bail','required','string','unique:users','between:3,20'],
            'email' =>  ['bail','required','email','unique:users','between:3,50'],
            'phone' =>  ['bail','required','string','unique:users'],
            'password' =>  ['bail','required','string','confirmed','between:5,20'],
        ];
    }
}
