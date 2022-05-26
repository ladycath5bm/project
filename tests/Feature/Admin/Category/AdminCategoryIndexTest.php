<?php

namespace Tests\Feature\Admin\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryIndexTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        Category::factory()->count(19)->create();
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testItListCategories()
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.index'));

        $response->assertOk();
        $response->assertViewIs('admin.categories.index');
        $response->assertViewHas('categories');
    }
}
