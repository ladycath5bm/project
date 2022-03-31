<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    public function created(Product $product)
    {
        //lanzar eventos o realizar acciones/trabajos/jobs
        /***Log::info(['message, created se ha creado un :model', ['model' => get_class($product)]], [
            'product_id' => $product->getKey()
        ]);**/
        Log::info('Se ha creado un product con id y usuario:', $this->info($product));
    }

    public function updated(Product $product)
    {
        Log::info(['message, updated se ha creado un :model', ['model' => get_class($product)]], [
            'product_id' => $product->getKey(),
        ]);
    }
    public function deleted(Product $product)
    {
        Log::warning(['message, deleted se ha creado un :model', ['model' => get_class($product)]], [
            'product_id' => $product->getKey(),
        ]);
    }

    public function forceDeleted(Product $product)
    {
        //
    }

    protected function info(Product $product): array
    {
        return [
            'product_id' => $product->getKey(),
            'uesr_id' => auth()->id(),
        ];
    }

    protected function getMessage(Product $product): string
    {
        //aqui iria la traducción
        //return 'model' => get_class($product)
        return 'product';
    }
}
