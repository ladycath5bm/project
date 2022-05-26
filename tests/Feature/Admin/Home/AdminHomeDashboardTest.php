<?php

namespace Tests\Feature\Admin\Home;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminHomeDashboardTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $employee;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');

        $this->admin = User::factory()->create()
            ->assignRole('admin');
        $this->user = User::factory()->create()
            ->assignRole('custom');
    }

    public function testItAdminCanSeeHomeDashboard(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.admin.home'));

        $response->assertOk();
        $response->assertViewIs('admin.index');

        $response->assertSee('categories');
        $response->assertSee('users');
        $response->assertSee('products');
    }

    public function testUserCantSeeHomeDashboard(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.admin.home'));

        $response->assertStatus(403);
        $response->assertDontSee('categories');
        $response->assertDontSee('users');
        $response->assertDontSee('products');
    }
}
