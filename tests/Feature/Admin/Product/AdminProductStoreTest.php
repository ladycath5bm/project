<?php

namespace Tests\Feature\Admin\Product;

use App\Constants\ProductStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductStoreTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private array $dataStore = [
        'name' => 'nametest',
        'code' => 124345,
        'price' => 323000,
        'stock' => 10,
        'discount' => 0,
        'description' => 'hola soy una descripcion',
        'status' => ProductStatus::ENABLED,
        'slug'=> 'soy un slug',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testAProductCanBeCreated()
    {
        $product = Product::create($this->dataStore);
        $response = $this->actingAs($this->user)->post(route('admin.products.store', $product));

        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    /* public function testValidateDataProductCreate($key, $data)
    {
        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasErrors([$key]);
    } */

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
