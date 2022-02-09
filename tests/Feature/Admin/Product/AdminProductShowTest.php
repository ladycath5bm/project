<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminProductShowTest extends TestCase
{
    use RefreshDatabase;

    public function testItVisitProduct(): void
    {
        $this->withoutMiddleware();

        $product = [
            'id' => 10,
            'name' => 'huji',
            'code' => 123003,
            'price' => 9990,
            'category_id' => 2,

        ];

        $response = $this->get(route('admin.products.show'));

        $response->assertOk();
    }
}
