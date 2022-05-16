<?php

namespace Tests\Feature\Admin\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminUserEditTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()
            ->create()
            ->assignRole('admin');
    }

    public function testItCanSeeEditUserForm()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.users.edit', $user));

        $response->assertViewIs('admin.users.edit');
        $response->assertViewHasAll(['user', 'roles']);
    }
}
