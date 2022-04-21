<?php

namespace Tests\Feature\Custom\Orders;

use Tests\TestCase;
use App\Models\Order;

class OrderIndexTest extends TestCase
{
    public function testYouCanSeeListOfOrders(): void
    {
        Order::factory()->create();
        $response = $this->get(route('orders.index'));

        //$response->assertOk();
        //$response->assertViewIs('orders.index');
        //$response->assertViewHas('orders');
    }
}
