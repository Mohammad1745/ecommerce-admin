<?php

namespace App\Http\Requests\Web;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class FlashSaleUpdateRequest extends FormRequest
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
            'id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'expires_at' => 'required|after:' . Carbon::now(),
            'flash_sale_price' => 'required|numeric|min:0',
        ];
    }
}
