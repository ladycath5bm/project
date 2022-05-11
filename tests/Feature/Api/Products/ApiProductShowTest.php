<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiProductShowTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanFetchASingleProduct()
    {
        $product = Product::factory()->create();

        $response = $this->getJson(route('api.products.show', $product));

        $response->assertSeeInOrder([
            $product->name,
            $product->code,
            $product->price,
            $product->description,
            $product->discount,
            $product->stock,
            $product->status,
        ]);

        $response->assertExactJson([
            'data' => [
                'type' => 'products',
                'id' => (string)$product->id,
                'attributes' => [
                    'name' => $product->name,
                    'code' => $product->code,
                    'price' => (string)$product->price,
                    'description' => $product->description,
                    'discount' => (string)$product->discount,
                    'stock' => (string)$product->stock,
                    'status' => $product->status,
                ],
                'links' => [
                    'self' => route('api.products.show', $product),
                ],
            ],
        ]);
    }
}
