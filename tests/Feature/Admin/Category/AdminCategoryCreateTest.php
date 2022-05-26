<?php

namespace Tests\Feature\Admin\Category;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryCreateTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testItVisitCreateCategory(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.create'));

        $response->assertOk();
        $response->assertViewIs('admin.categories.create');
    }
}
