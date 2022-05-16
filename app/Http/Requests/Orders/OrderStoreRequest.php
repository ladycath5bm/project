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
            'name' => 'required|string|max:120',
            'document' => 'required|min:5|max:25',
            'email' => 'required|string|max:50',
            'mobile' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];
    }
}
