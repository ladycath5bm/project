<?php

namespace App\Rules;

use App\Contracts\ImportProductRulesContract;

class ProductImportRules  implements ImportProductRulesContract

{
    public static function toArray(): array
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'code' => ['required'],
            'price' => ['required'],
            'discount' => ['required'],
            'category' => ['required'],
            'stock' => ['required'],
        ];
    }
}
