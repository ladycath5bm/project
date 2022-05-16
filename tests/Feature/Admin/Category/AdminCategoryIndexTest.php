<?php

namespace Tests\Feature\Admin\Category;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
