<?php

namespace App\Http\Requests;

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
            'name' => 'required|max:15',
            'code' => 'required|numeric|integer|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'name of product',
            'code' => 'code of product',
            'price' => 'price of product',
            'stock' => 'availale units of product'
        ];        
    }
}
