<?php

namespace Tests\Feature\Admin\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryShowTest extends TestCase
{
    use RefreshDatabase;

    public function testItVisitCategory(): void
    {
        $category = ['id' => 23, 'name' => 'laravel'];

        $response = $this->get(route('admin.categories.show'), $category);

        $response->assertOk();
    }
}
