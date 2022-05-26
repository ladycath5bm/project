<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiProductShowTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

        Sanctum::actingAs($this->user);
    }

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

        $response->assertJson([
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
