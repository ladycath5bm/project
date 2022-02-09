<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductIndexAdminTest extends TestCase
{
    use RefreshDatabase;

    public function testItVisitListProduct(): void
    {
        $this->withoutMiddleware();

        $response = $this->get(route('admin.products.index'));

        $response->assertOk();
    }

    public function testItListProduct(): void 
    {
        $this->withoutMiddleware();

        Category::factory(4)->create();
        Product::factory()->count(2)->create();

        $response=$this->get(route('admin.products.index'));

        $response->assertOk();
        $response->assertViewIs('admin.products.index');
        $response->assertViewHas('products');
    }
}
