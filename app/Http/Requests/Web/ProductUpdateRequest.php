<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'id' => 'required|numeric|integer',
            'name' => (isset($this->name) ? 'required|string' : ''),
            'description' => (isset($this->description) ? 'required|string' : ''),
            'brand_id' => (isset($this->brand_id) ? 'numeric|integer' : ''),
            'regular_price' => (isset($this->regular_price) ? 'numeric|min:0' : ''),
            'sell_price' => (isset($this->sell_price) ? 'numeric|min:0' : ''),
            'quantity' => (isset($this->quantity) ? 'numeric|integer|min:0' : ''),
        ];
    }
}
