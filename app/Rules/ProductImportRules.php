<?php

namespace App\Rules;

use App\Contracts\ImportProductRulesContract;

class ProductImportRules implements ImportProductRulesContract
{
    public static function toArray(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'description' => ['required', 'string', 'max:120'],
            'code' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'category' => ['required', 'string'],
            'stock' => ['required', 'numeric', 'min:0', 'max:99999999999'],
        ];
    }
}
