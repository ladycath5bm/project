<?php

namespace Tests\Feature\Admin\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminProductCreateTest extends TestCase
{

    public function testItVisitCreateproduct(): void
    {
        $response = $this->get(route('admin.products.create'));

        $response->assertOk();
    }

    public function testItCreateProducts(): void
    {
        $response = $this->get(route('admin.products.create'));

        $response->assertViewIs('admin.products.create');
        //$response->assertViewHas();
    }
}
