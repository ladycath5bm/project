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

        $file = new UploadedFile(base_path('public/storage/exports/products.xlsx'), 'products.xlsx');

        $response = $this->actingAs($user)->post('admin/import', [
            'file' => $file,
        ]);

        $response->assertRedirect();
        
        Excel::assertImported('products.xlsx', function(ProductsImport $import) {
            return true;
        });
    
    }
}
