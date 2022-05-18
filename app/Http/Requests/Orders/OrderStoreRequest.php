<?php

namespace App\Http\Requests\Orders;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Cart::content()->isNotEmpty();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120|min:5',
            'document' => 'required|numeric|min:999999|max:99999999999',
            'email' => 'required|email|max:50',
            'mobile' => 'required|numeric|min:99999|max:999999999999',
            'address' => 'required|string|max:100|min:10',
        ];
    }
}
