<?php

namespace Tests\Feature\Admin\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductIndexTest extends TestCase
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

    public function testItCanSeeIndexAdminProducts(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.products.index'));

        $response->assertOk();
        $response->assertViewIs('admin.products.index');
    }
}
