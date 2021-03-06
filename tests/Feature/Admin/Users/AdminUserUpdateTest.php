<?php

namespace Tests\Feature\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminUserUpdateTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private user $userTest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()
            ->create()
            ->assignRole('admin');

        $this->userTest = User::factory()
            ->create()
            ->assignRole('custom');
    }

    public function testItCanUpdateAUserRole(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        $userUpdate = [
            'role' => $adminRole->id,
        ];

        $response = $this->actingAs($this->user)
            ->patch(route('admin.users.update', $this->userTest), $userUpdate);

        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabasehas('users', [
            'id' => $this->userTest->id,
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'model_id' => $this->userTest->id,
            'role_id' => $adminRole->id,
        ]);
    }
}
