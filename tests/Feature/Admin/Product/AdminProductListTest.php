<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductListTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private $products;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()
            ->create()
            ->assignRole('admin');
        $this->products = Product::factory()->count(10)->create();
    }

    public function testItVisitListProduct(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.products.list'));

        $response->assertOk();
        $response->assertViewIs('admin.products.list');
        $response->assertViewHas('products');
    }
}
