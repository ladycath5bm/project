<?php

namespace Tests\Feature\Admin\Imports;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportFileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testItCanImportProductsFile()
    {
        $this->artisan('db:seed --class=RoleSeeder');

        Category::create(['name' => 'sed']);
        $user = User::factory()->create()->assignRole('admin');

        $file = new UploadedFile(base_path('tests/stubs/products.xlsx'), 'products.xlsx');

        $response = $this->actingAs($user)->post('admin/import', [
            'file' => $file,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('products', 20);

        $this->assertDatabaseHas('products', [
            'name' => 'nam',
            'code' => 20801,
            'price' => '830842.00',
            'description' => 'Repellendus quia quia doloribus magni in aut.',
            'discount' => '23.00',
            'stock' => 2560,
            'status' => 1,
        ]);
    }
}
