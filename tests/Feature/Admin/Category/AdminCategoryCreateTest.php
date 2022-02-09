<?php

namespace Tests\Feature\Admin\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCategoryCreateTest extends TestCase
{
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

