<?php

namespace Tests\Feature\Api\Products;

use App\Constants\ProductStatus;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiProductStoreTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function testItCanStoreAProduct()
    {
        $data = [
            'name' => 'celular',
            'code' => 892389,
            'price' => 230000,
            'description' => 'descripcion del producto',
            'discount' => 0,
            'stock' => '25',
            'status' => ProductStatus::ENABLED,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
        ];

        $response = $this->postJson(route('api.products.store'), $data);

        $this->assertDatabaseHas('products', [
            'name' => 'celular',
            'code' => '892389',
            'price' => '230000',
            'description' => 'descripcion del producto',
            'discount' => '0',
            'stock' => '25',
            'status' => ProductStatus::ENABLED,
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
        ]);
    }
}
