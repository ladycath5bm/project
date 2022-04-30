<?php

namespace Tests\Feature\Custom\Orders;

use App\Models\Order;
use Tests\TestCase;

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
