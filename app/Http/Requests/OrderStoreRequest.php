<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OrderStoreRequest
 * @package App\Http\Requests
 * @property int currency_id
 * @property string phone
 * @property mixed|array positions
 * @property mixed|array delivery
 */
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
            'delivery' => 'required',
            'delivery.type_id' => 'required|numeric|exists:delivery_types,id',
            'delivery.coordinates.address' => 'nullable|string|required_if:delivery.type_id,1',
            'delivery.coordinates.lat' => 'nullable|numeric',
            'delivery.coordinates.lng' => 'nullable|numeric',
        ];
    }
}
