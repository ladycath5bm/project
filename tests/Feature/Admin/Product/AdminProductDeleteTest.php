<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductDeleteTest extends TestCase
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

    public function testItCanDeleteAProduct(): void
    {
        $product = Product::create([
            'name' => 'televisor',
            'description' => 'Tv 32 pulgas, smart tv',
            'code' => 2343546,
            'price' => 600000,
            'discount' => 0,
            'stock' => 10,
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('admin.products.destroy', $product));

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseCount('products', 0);
        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    
    }
}
