<?php

namespace Tests\Feature\Admin\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryUpdateTest extends TestCase
{
    use RefreshDatabase;
    private User $user;
    private array $data = [
        'name' => 'nevera',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testItCanUpdateACategory()
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->user)->patch(route('admin.categories.update', $category), $this->data);

        $response->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseCount('categories', 1);
        $this->assertDatabaseHas('categories', ['name' => 'nevera']);
    }
}
