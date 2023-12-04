<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetScheduleTimeRequest extends FormRequest
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
            'day' => ['required', 'string', 'in:saturday,sunday,monday,tuesday,wednesday,thursday,friday,not_friday,all'],
            'start_time' => ['required', 'time'],
            'end_time' => ['required', 'time']
        ];
    }
}
