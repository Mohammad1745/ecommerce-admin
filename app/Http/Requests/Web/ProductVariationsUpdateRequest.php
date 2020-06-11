<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariationsUpdateRequest extends FormRequest
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
            'product_id' => 'required|numeric|integer',
            'product_variation_id' => 'required|array',
            'product_variation_id.*' => 'required|numeric|integer',
            'price' => 'required|array',
            'price.*' => 'required|numeric|integer|min:0',
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric|integer|min:0',
        ];
    }
}
