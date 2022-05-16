<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:120',
            'code' => 'required|numeric|integer|unique:products',
            'price' => 'required|numeric',
            'discount' => 'required|numeric|integer',
            'stock' => 'required|integer',
            'description' => 'required|max:250|string',
            'user_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'file' => 'image',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'name of product',
            'code' => 'code of product',
            'price' => 'price of product',
            'stock' => 'availale units of product',
        ];
    }
}
