<?php

namespace Tests\Feature\Admin\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryStoreTest extends TestCase
{
    //use RefreshDatabase;

    private array $data = [
        'name' => 'kepler',
    ];

    public function testACategoryCanBeCreated()
    {
        $response = $this->post(route('admin.categories.store'), $this->data);

        $response->assertRedirect();
    }
}
