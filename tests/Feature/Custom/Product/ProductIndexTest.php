<?php

namespace Tests\Feature\Custom\Product;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductIndexTest extends TestCase
{
    use RefreshDatabase;
    
    public function testGuestItVisitListProduct(): void
    {
        
        $response = $this->get(route('products.index'));

        $response->assertOk();
    }

    public function testGuestItListProduct(): void 
    {
        Product::factory()->count(2)->create();

        $response=$this->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
    }
}
