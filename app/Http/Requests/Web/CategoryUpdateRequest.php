<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'parent_id' => (isset($this->parent_id) ? 'numeric|integer|different:id' : ''),
            'image' => (isset($this->image) ? 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:4000' : ''),
        ];
    }
}
