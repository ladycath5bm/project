<?php

namespace Tests\Feature\Admin\Category;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryStoreTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private array $data = [
        'name' => 'kepler',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testACategoryCanBeCreated()
    {
        $response = $this->actingAs($this->user)->post(route('admin.categories.store'), $this->data);

        $response->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseCount('categories', 1);
        $this->assertDatabaseHas('categories', ['name' => 'kepler']);
    }
}
