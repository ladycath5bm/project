<?php

namespace Tests\Feature\Admin\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryEditTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testItCanEditACategory(): void
    {
        $category = Category::factory()->create();
        
        $response = $this->actingAs($this->user)->get(route('admin.categories.edit', $category));

        $response->assertOk();
        $response->assertViewIs('admin.categories.edit');
        $response->assertViewHas('category');
    }
}
