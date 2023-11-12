<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAddressRequest extends FormRequest
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
            'x' => ['required','decimal:0,6'],
            'y' => ['required','decimal:0,6'],
            'address' => ['required', 'string', 'between:5,255'],
            'vahed' => ['required', 'numeric', 'between:1,200'],
            'user_id' => ['required', 'exists:user,id']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['user_id' => Auth::id()]);
    }
}
