<?php

namespace App\Http\Requests;

use App\Helpers\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if($this->header('Content-Type') !== 'application/json' && $this->header('Accept') !== 'application/json') {
            return [
                'data' => [function($attribute, $value, $fail) {
                    $fail('Accept and Content-Type not According.');
                }],
            ];
        }

        return [
            'data.name' => 'required|string',
            'data.description' => 'required|string',
            'data.price' => 'required|integer',
            'data.variants' => ['required', 'array'],
        ];
    }
}
