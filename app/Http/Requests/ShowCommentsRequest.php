<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'food_id'=>['nullable','exists:food,id'],
            'restaurant_id'=>['nullable','exists:restaurants,id'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (!$this->food_id && !$this->restaurant_id) {
                    $validator->errors()->add(
                        'filter values',
                        'please enter restaurant or food to show comments , enter only one'
                    );
                }elseif ($this->food_id && $this->restaurant_id){
                    $validator->errors()->add(
                        'filter values',
                        'please enter restaurant or food to show comments , not both'
                    );
                }
            },

        ];
    }
}
