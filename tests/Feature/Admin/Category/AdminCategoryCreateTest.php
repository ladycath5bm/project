<?php

namespace Tests\Feature\Admin\Category;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AdminCategoryCreateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        //$user->assignRole('admin');
        Sanctum::actingAs($user);
    }
    
    public function testItVisitCreateCategory(): void
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertOk();
    }

    public function testItCreateProducts(): void
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertViewIs('admin.categories.create');
    }
}
