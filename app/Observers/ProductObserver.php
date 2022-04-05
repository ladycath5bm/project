<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    public function created(Product $product)
    {
        Log::info('Se ha creado un producto con id y usuario:', $this->info($product));
    }

    public function updated(Product $product)
    {
        Log::info(['message, se ha actualizado un producto'], [
            'product_id' => $product->getKey(),
        ]);
    }
    public function deleted(Product $product)
    {
        Log::warning(['message, se ha eliminado un producto'], [
            'product_id' => $product->getKey(),
        ]);
    }

    protected function info(Product $product): array
    {
        return [
            'product_id' => $product->getKey(),
            'uesr_id' => auth()->id(),
        ];
    }

}
