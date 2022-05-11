<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiProductUpdateTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Category $category;
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create();
    }

    public function testItCanUpdateAProduct()
    {
        //$response = $this->
    }
}
