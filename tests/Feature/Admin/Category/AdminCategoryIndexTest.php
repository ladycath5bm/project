<?php

namespace Tests\Feature\Admin\Category;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryIndexTest extends TestCase
{
    //use RefreshDatabase;
    public function testItVisitListCategories()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertOk();
    }

    public function testItListCategories()
    {
        Category::factory(10)->create();

        $response = $this->get(route('admin.categories.index'));

        $response->assertOk();
        $response->assertViewIs('admin.categories.index');
    }
}
