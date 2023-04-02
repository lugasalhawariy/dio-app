<?php

namespace App\Http\Requests;

use App\Helpers\JsonResponse;
use Hamcrest\Core\IsTypeOf;
use Illuminate\Foundation\Http\FormRequest;

use function PHPUnit\Framework\isType;

class SaleRequest extends FormRequest
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
        // dd($this->header('Content-Type') != 'application/json', $this->header('Accept'));
        return [
            'data.payment_method' => 'required|string|in:gopay,ovo,shopeepay,linkaja',
            'data.cart' => ['required', 'array', function($attribute, $value, $fail) {
                foreach($value as $item) {
                    if(!isset($item['product_uuid'])) {
                        $fail('Product uuid is required');
                    }
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'data.payment_method.in' => 'Payment method must be gopay, ovo, shopeepay, linkaja',
            'data.cart' => 'Cart must be array',
        ];
    }
}
