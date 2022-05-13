<?php

namespace Tests\Feature\Api\Products;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use App\Constants\ProductStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        Sanctum::actingAs($this->user);
    }

    public function testItCanUpdateAProduct()
    {
        $data = [
            'name' => 'celular',
            'code' => $this->product->code,
            'price' => 123000,
            'discount' => 30,
            'stock' => 50,
            'category_id' => $this->category->id,
            'description' => 'celular marca xyz 4 ram 64 gb.',
            'status' => ProductStatus::DISABLED,
        ];

        $response = $this->patchJson(route('api.products.update', $this->product), $data);

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'name' => 'celular',
            'code' => $this->product->code,
            'price' => 123000,
            'discount' => 30,
            'stock' => 50,
            'category_id' => $this->category->id,
            'description' => 'celular marca xyz 4 ram 64 gb.',
            'status' => ProductStatus::DISABLED,
        ]);
    }
}
