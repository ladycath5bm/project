<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminProductShowTest extends TestCase
{
    use RefreshDatabase;

    public function testItVisitProduct(): void
    {
        //$this->withoutMiddleware();
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.products.show', $product));

        $response->assertOk();
    }
}
