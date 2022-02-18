<?php

namespace App\Http\Requests;

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
            'name' => 'required|max:15',
            'code' => 'required|numeric|integer|exists:products,code',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required|max:250|string',
        ];
    }
}
