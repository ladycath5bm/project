<?php

namespace Tests\Feature\Admin\Imports;

use App\Constants\ProductStatus;
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

        Category::create(['name' => 'celu']);
        $user = User::factory()->create()->assignRole('admin');

        $file = new UploadedFile(base_path('tests/stubs/productsinerror.xlsx'), 'productsinerror.xlsx');

        $response = $this->actingAs($user)->post(route('admin.products.import'), ['file' => $file]);

        $response->assertRedirect();

        $this->assertDatabaseCount('products', 10);

        $this->assertDatabaseHas('products', [
            'name' => 'kepler',
            'code' => 357599,
            'price' => 116102,
            'description' => 'Illum debitis est tempore doloremque ipsa molestiae delectus nisi.',
            'discount' => 95,
            'stock' => 7847,
            'status' => ProductStatus::DISABLED,
        ]);
    }
}
