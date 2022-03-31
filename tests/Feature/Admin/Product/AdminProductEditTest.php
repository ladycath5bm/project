<?php

namespace Tests\Feature\Admin\Product;

use Tests\TestCase;

class AdminProductEditTest extends TestCase
{
    public function test_example()
    {
        $response = $this->get(route('admin.products.edit'));

        $response->assertOk();
    }
}
