<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminProductEditTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()
            ->create()
            ->assignRole('admin');
    }

    public function testItCanSeeEditFormProduct()
    {
        $product = Product::factory()->create();
        Category::factory()->count(10)->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.products.edit', $product));
        
        $response->assertOk();
        $response->assertViewIs('admin.products.edit');
        $response->assertViewHasAll(['product', 'categories']);
    }

}
