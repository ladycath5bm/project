<?php

namespace Tests\Feature\Custom\Orders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderIndexTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()
            ->create()
            ->assignRole('custom');
    }

    public function testYouCanSeeListOfOrders(): void
    {
        $orders = Order::factory()->count(5)->create();

        $response = $this->actingAs($this->user)
            ->get(route('orders.index'));

        $response->assertViewIs('orders.index');
        $response->assertViewHas('orders');
    }
}
