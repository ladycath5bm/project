<?php

namespace Tests\Feature\Custom\Product;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductIndexTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('custom');
    }

    public function testGuestItListProduct(): void
    {
        $categories = Category::factory()->create();
        $products = Product::factory()->count(2)->create();

        $response = $this->actingAs($this->user)
            ->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('custom.products.index');
        $response->assertViewHasAll(['products', 'categories']);
    }
}
