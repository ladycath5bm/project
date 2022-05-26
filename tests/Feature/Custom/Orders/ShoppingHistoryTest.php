<?php

namespace Tests\Feature\Custom\Orders;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShoppingHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $user = User::factory()->create();
        $user->assignRole('custom');
        Sanctum::actingAs($user);
    }

    public function testYouCanSeeYourShoppingHistory(): void
    {
        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertViewIs('orders.index');
    }
}
