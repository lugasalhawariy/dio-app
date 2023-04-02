<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if($this->header('Content-Type') !== 'application/json' && !$this->header('Accept') !== 'application/json') {
            return [
                'data' => [function($attribute, $value, $fail) {
                    $fail('Accept and Content-Type not According.');
                }],
            ];
        }

        return [
            'data.name' => ['required', 'string', 'max:255'],
            'data.price' => 'required|integer',
            'data.amount' => 'required|integer',
            'data.unit' => 'required|string|in:gram,litres,items',
        ];
    }
}
