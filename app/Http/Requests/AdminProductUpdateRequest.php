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
            'code' => 'required|numeric|integer|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required|max:2501string',
        ];
    }
}
