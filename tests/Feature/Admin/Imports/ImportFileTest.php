<?php

namespace Tests\Feature\Admin\Imports;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ImportFileTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        //$user->assignRole('admin');
        Sanctum::actingAs($user);
    }

    public function testImportFile()
    {
        $file = new UploadedFile(base_path('tests/stubs/products.xlsx'), 'products.xlsx');

        $response = $this->post('admin/import', [
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
            'category_id' => 10,
        ]);
    }
}
