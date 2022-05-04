<?php

namespace Tests\Feature\Admin\Imports;

use Tests\TestCase;
use App\Models\User;
use App\Imports\ProductsImport;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExcelImportProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_import_users() 
    {
        $this->artisan('db:seed --class=RoleSeeder');
        $user = User::factory()->create()->assignRole('admin');
        
        Excel::fake();

        //$response = $this->actingAs($user)->post('admin/import');
        
        $file = new UploadedFile(base_path('public/storage/exports/products.xlsx'), 'products.xlsx');

        $response = $this->actingAs($user)->post('admin/import', [
            'file' => $file,
        ]);

        $response->assertRedirect();
        
        Excel::assertImported('products.xlsx', function(ProductsImport $import) {
            return true;
        });

/*         $this->assertDatabaseCount('products', 20);

        $this->assertDatabaseHas('products', [
            'name' => 'nam',
            'code' => 20801,
            'price' => '830842.00',
            'description' => 'Repellendus quia quia doloribus magni in aut.',
            'discount' => '23.00',
            'stock' => 2560,
            'status' => 1,
        ]); */
    
    }
}
