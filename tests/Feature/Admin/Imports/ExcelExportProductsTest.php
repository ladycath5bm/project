<?php

namespace Tests\Feature\Imports;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Carbon;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportProductsTest extends TestCase
{


    public function testUserCanDownloadProductsExport()
    {
        $user = User::factory()->create();
        Excel::fake();
        $data = ['date1' => Carbon::now()->subDays(5),
            'date2' => now(),
            'categories' => 'all',
            'satus' => 'all'];

        $response = $this->actingAs($user)->get('admin/export/', [
            'request' => $data
        ]);

        $response->assertRedirect();

        Excel::assertStored('products.xlsx', function(ProductsExport $export) {
            return true;
        });

    }

}
