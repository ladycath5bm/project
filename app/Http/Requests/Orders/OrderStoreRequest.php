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
            'name' => 'required|string|max:40',
            'document' => 'required|min:5|max:25',
            'email' => 'required|email|max:20',
            'mobile' => 'required|alpha_num|max:15',
            'address' => 'required|string|max:50',
        ];
    }
}
