<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFoodRequest extends FormRequest
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
            'name' => ['bail', 'required', 'string', 'between:3,20',
                Rule::unique('food')
                    ->ignore($this->get('id'))
            ],
            'materials' => ['nullable'],
            'price' => ['bail', 'required', 'numeric', 'min:10000'],
            'food_tier_id' => ['bail', 'required', 'numeric', 'exists:food_tiers,id'],
            'percent' => ['bail','nullable','numeric','between:0,80']
        ];
    }

    protected function prepareForValidation()
    {
        $this->mergeIfMissing([
            'percent' => 0
        ]);
    }

}
