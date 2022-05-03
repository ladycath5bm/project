<?php

namespace Tests\Feature\Imports;

use App\Exports\ProductsExport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExcelImportProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanDownloadProductsExport()
    {
        $this->artisan('db:seed --class=RoleSeeder');
        $user = User::factory()->create()->assignRole('admin');

        Excel::fake();

        $data = [
            'date1' => Carbon::now()->subDays(5),
            'date2' => now(),
            'categories' => 'all',
            'satus' => 'all',
        ];

        $response = $this->actingAs($user)
            ->get(route('admin.products.export', $data));

        //$responseDownload = $this->actingAs($user)->get(route('admin.exports.file'));

        $response->assertRedirect();

        Excel::assertStored('public/exports/products-' . date('Y-m-d H') . '.xlsx', function (ProductsExport $export) {
            return true;
        });
    }

    public function testUserCanQueueProductsExport()
    {
        $this->artisan('db:seed --class=RoleSeeder');
        $user = User::factory()->create()->assignRole('admin');

        Excel::fake();

        $data = [
            'date1' => Carbon::now()->subDays(5),
            'date2' => now(),
            'categories' => 'all',
            'satus' => 'all',
        ];

        $this->actingAs($user)
            ->get(route('admin.products.export', $data));

        Excel::assertQueued('public/exports/products-' . date('Y-m-d H') . '.xlsx', function (ProductsExport $export) {
            return true;
        });
    }
}
