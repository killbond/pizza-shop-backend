<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency_id' => 'required|numeric|exists:currencies,id',
            'phone' => 'required|string',
            'positions' => 'required',
            'positions.*.product_id' => 'required|numeric|exists:products,id',
            'positions.*.quantity' => 'required|integer|gt:0',
        ];
    }
}
