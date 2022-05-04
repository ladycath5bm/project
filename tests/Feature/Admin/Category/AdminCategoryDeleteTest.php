<?php

namespace Tests\Feature\Admin\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryDeleteTest extends TestCase
{
    use RefreshDatabase;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testItCanDeleteACategory(): void
    {
        $category = Category::create(['name' => 'celular']);

        $response = $this->actingAs($this->user)->delete(route('admin.categories.destroy', $category));
        $response->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseCount('categories', 0);
        $this->assertDatabaseMissing('categories', ['name' => 'celular']);

    }
}
