<?php

namespace Tests\Feature\Api\Products;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiProductDeleteTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::factory()->create();
        $this->user = User::factory()->create();

        Sanctum::actingAs($this->user);
    }

    public function testItCanDeleteAproduct()
    {
        $response = $this->deleteJson(route('api.products.destroy', $this->product));

        $this->assertDatabaseMissing('products', [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'code' => $this->product->code,
        ]);
    }
}
