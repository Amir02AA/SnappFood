<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortArchiveRequest extends FormRequest
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
            'from' => ['nullable','date','before:'.now()->toDateString()],
            'to' => ['nullable','date','before_or_equal:'.now()->toDateString()],
            'paginate' => ['in:5,10,15,20']

        ];
    }
}
