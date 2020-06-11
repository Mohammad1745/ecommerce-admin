<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariationImageUpdateRequest extends FormRequest
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
            'product_variation_ids' => 'required|array',
            'product_variation_ids.*' => 'required|numeric|integer',
            'images' => 'array',
            'images.*' => 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:4000',
        ];
    }
}
