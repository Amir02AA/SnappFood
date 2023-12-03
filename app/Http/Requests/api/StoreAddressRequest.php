<?php

namespace App\Http\Requests\api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

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
            'lang' => ['required', 'decimal:0,6'],
            'long' => ['required', 'decimal:0,6'],
            'address' => ['required', 'string', 'between:5,255'],
            'vahed' => ['required', 'numeric', 'between:1,200'],
            'name' => ['required', 'string', 'between:3,50',Rule::unique('addresses')->where(function ($query){
                    $query->where('addressable_id',Auth::id())->where('addressable_type',User::class);
                })]
        ];
    }

}
