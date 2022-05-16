<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiProductIndexTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

        Sanctum::actingAs($this->user);
    }

    public function testItCanFetchAListofProducts()
    {
        $products = Product::factory()->count(2)->create();

        $response = $this->getJson(route('api.products.index'));

        $response->assertJson([
            'data' => [
                [
                    'type' => 'products',
                    'id' => (string)$products[0]->id,
                    'attributes' => [
                        'name' => $products[0]->name,
                        'code' => $products[0]->code,
                        'price' => (string)$products[0]->price,
                        'description' => $products[0]->description,
                        'discount' => (string)$products[0]->discount,
                        'stock' => (string)$products[0]->stock,
                        'status' => $products[0]->status,
                    ],
                    'links' => [
                        'self' => route('api.products.show', $products[0]),
                    ],
                ],
                [
                    'type' => 'products',
                    'id' => (string)$products[1]->id,
                    'attributes' => [
                        'name' => $products[1]->name,
                        'code' => $products[1]->code,
                        'price' => (string)$products[1]->price,
                        'description' => $products[1]->description,
                        'discount' => (string)$products[1]->discount,
                        'stock' => (string)$products[1]->stock,
                        'status' => $products[1]->status,
                    ],
                    'links' => [
                        'self' => route('api.products.show', $products[1]),
                    ],
                ],
            ],
            'links' => [
                'self' => route('api.products.index'),
            ],
        ]);
    }
}
