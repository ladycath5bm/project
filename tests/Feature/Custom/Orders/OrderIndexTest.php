<?php

namespace Tests\Feature\Custom\Orders;

use Tests\TestCase;

class OrderIndexTest extends TestCase
{
    public function testYouCanSeeListOfOrders(): void
    {
        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertViewIs('orders.index');
        $response->assertViewHas('orders');
    }
}
