<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowFoodRequest extends FormRequest
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
    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'price_filter' => 'asc',
        ]);
    }

    public function rules(): array
    {
        return [
            'price_filter' => ['required','in:asc,desc'],
            'tier_filter' => ['nullable','exits:food,id'],
            'paginate' => ['in:5,10,15,20']
        ];
    }

    protected function passedValidation()
    {

    }
}
