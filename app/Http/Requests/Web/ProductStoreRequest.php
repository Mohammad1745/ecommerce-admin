<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'brand_id' => 'required|numeric|integer',
            'regular_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|integer|min:0',
        ];
    }
}
