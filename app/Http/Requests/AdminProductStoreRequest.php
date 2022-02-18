<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->user_id == auth()->user()->id) {
            return true;
        } else {
            return false;
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:15',
            'code' => 'required|numeric|integer|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required|max:2501string',
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
            'stock' => 'availale units of product'
        ];
    }
}
