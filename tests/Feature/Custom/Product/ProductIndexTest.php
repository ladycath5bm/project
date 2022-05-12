<?php

namespace Tests\Feature\Custom\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestItListProduct(): void
    {
        $categories = Category::factory()->create();
        $products = Product::factory()->count(2)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('custom.products.index');
        $response->assertViewHasAll(['products', 'categories']);
    }
}
