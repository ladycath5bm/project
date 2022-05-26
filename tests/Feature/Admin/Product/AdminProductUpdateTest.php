<?php

namespace Tests\Feature\Admin\Product;

use App\Constants\ProductStatus;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductUpdateTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
        $this->product = Product::factory()
            ->create();
    }

    public function testItCanUpdateAProduct(): void
    {
        $category = Category::factory()->create();
        $this->product->category_id = $category->id;
        $this->product->save();

        $dataUpdate = [
            'name' => 'nametest',
            'code' => $this->product->code,
            'price' => 323000,
            'stock' => 10,
            'discount' => 10,
            'description' => 'hola soy una descripcion',
            'status' => ProductStatus::ENABLED,
            'category_id' => $category->id,
        ];

        $reponse = $this->actingAs($this->user)->patch(route('admin.products.update', $this->product), $dataUpdate);

        $reponse->assertRedirect(route('admin.products.list'));

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'name' => 'nametest',
            'code' => $this->product->code,
            'price' => '323000.00',
            'discount' => 10,
            'description' => 'hola soy una descripcion',
            'status' => ProductStatus::ENABLED,
            'category_id' => $category->id,
        ]);
    }
}
