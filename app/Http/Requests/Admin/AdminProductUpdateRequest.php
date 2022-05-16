<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|max:120',
            'code' => 'required|numeric|integer|unique:products,code,' . $this->route('product')->id,
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required|max:250|string',
            'discount' => 'required|numeric|integer',
            'category_id' => 'required',
            'status' => 'required',
        ];
    }
}
