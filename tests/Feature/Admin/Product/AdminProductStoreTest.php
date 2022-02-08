<?php

namespace Tests\Feature\Admin\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminProductStoreTest extends TestCase
{
    use RefreshDatabase;
    public function testAProductCanBeCreated()
    {
        $this->withoutMiddleware();
        $data = [
            'name' => 'nameterst',
            'code' => 124345,
            'price' => 323,
            'stock' => 10,
        ];
        //dd($data);
        $response = $this->post(route('admin.products.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', $data);
    }     
    
    public function testValidateDataProductCreate()
    {
        $this->withoutMiddleware();
        $data = [
            'name' => null,
            'code' => 124345,
            'price' => 323,
            'stock' => 10,
        ];
        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasErrors(['name']);
    }
}
