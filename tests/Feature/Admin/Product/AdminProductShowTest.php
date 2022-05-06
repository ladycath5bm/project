<?php

namespace Tests\Feature\Admin\Product;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminProductShowTest extends TestCase
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

    public function testItCanSeeProduct(): void
    {

        $product = Product::factory()->create();
        $product->category_id = Category::factory()->create()->id;
        $product->save();

        $response = $this->actingAs($this->user)->get(route('admin.products.show', $product));

        $response->assertViewIs('admin.products.show');
        $response->assertViewHas('product');
    }
}
