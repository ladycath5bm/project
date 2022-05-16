<?php

namespace Tests\Feature\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserIndexTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testAdminCanVisitListUsers(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.users.index'));

        $response->assertOk();
        $response->assertViewIs('admin.users.index');
        $response->assertViewHas('users');
    }
}
