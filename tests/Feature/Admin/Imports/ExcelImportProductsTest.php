<?php

namespace Tests\Feature\Admin\Imports;

use Tests\TestCase;
use App\Models\User;
use App\Imports\ProductsImport;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExcelImportProductsTest extends TestCase
{
   
    public function test_user_can_import_users() 
    {
        $user = User::factory()->create();
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
    
    }
}