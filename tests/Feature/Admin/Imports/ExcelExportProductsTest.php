<?php

namespace Tests\Feature\Imports;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Carbon;
use App\Exports\ProductsExport;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanDownloadProductsExport()
    {
        $this->artisan('db:seed');
        $user = User::factory()->create()->assignRole('admin');

        Excel::fake();

        $data = ['date1' => Carbon::now()->subDays(5),
            'date2' => now(),
            'categories' => 'all',
            'satus' => 'all'];

        $response = $this->actingAs($user)->get(route('admin.products.export', $data));
        $responseDownload = $this->actingAs($user)->get(route('admin.exports.file'));

        $response->assertRedirect();

        Excel::assertStored('public/exports/products-' . date('Y-m-d H') . '.xlsx', function(ProductsExport $export) {
            return true;
        });

    }

}
