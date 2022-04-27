<?php

namespace Tests\Feature\Admin\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductStoreTest extends TestCase
{
    //use RefreshDatabase;

    private array $dataStore = [
            'name' => 'nametest',
            'code' => 124345,
            'price' => 323000,
            'stock' => 10,
            'discount' => 0,
            'description' => 'hola soy una decricion',
            'status' => 0,
            'slug'=> null,
            'category_id'=> null,
            'user_id'=> null,
            'created_at'=> '2022-04-21 04:40:24',
            'updated_at'=> '2022-04-21 04:40:24',
    ];

    public function testAProductCanBeCreated()
    {
        $this->withoutMiddleware();

        $response = $this->post(route('admin.products.store'), $this->dataStore);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', $this->dataStore);
    }
    /**
     * @dataProvider invalidInputForCreatedProduct
     */
    public function testValidateDataProductCreate($key, $data)
    {
        $this->withoutMiddleware();

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasErrors([$key]);
    }

    public function invalidInputForCreatedProduct(): array
    {
        return [
            'name has null' => ['name', array_replace_recursive($this->dataStore, ['name' => null])],
            'name max character' => ['name', array_replace_recursive($this->dataStore, ['name' => 'dsfgreqwasdfrede'])],

            'code has null' => ['code', array_replace_recursive($this->dataStore, ['code' => null])],
            'code is not numeric' => ['code', array_replace_recursive($this->dataStore, ['code' => 'df'])],
            'code is not integer' => ['code', array_replace_recursive($this->dataStore, ['code' => 123.23])],

            'price has null' => ['price', array_replace_recursive($this->dataStore, ['price' => null])],
            'price is not numeric' => ['price', array_replace_recursive($this->dataStore, ['price' => 'testnumerics'])],

            'stock has null' => ['stock', array_replace_recursive($this->dataStore, ['stock' => null])],
            'stock is not numeric' => ['stock', array_replace_recursive($this->dataStore, ['stock' => 'testnumeric'])],

        ];
    }
}