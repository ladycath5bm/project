<?php

namespace Tests\Feature\Imports;

use App\Exports\ProductsExport;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExcelImportProductsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        //$user->assignRole('admin');
        Sanctum::actingAs($user);
    }

    public function testUserCanDownloadProductsExport()
    {
        Excel::fake();
        //$user = User::factory()->create();
        //$user->assignRole('admin');
        //Sanctum::actingAs($user);
        $this->get(route('admin.products.export'));

        Excel::assertStored('products-' . date('Y-m-d H') . '.xlsx', 'public/storage/exports');

        Excel::assertStored('products-' . date('Y-m-d H') . '.xlsx', 'public/storage/exports', function (ProductsExport $export) {
            return true;
        });

        // When passing the callback as 2nd param, the disk will be the default disk.
        Excel::assertStored('products-' . date('Y-m-d H') . '.xlsx', function (ProductsExport $export) {
            return true;
        });
    }

    public function test_user_can_queue_invoices_export()
    {
        Excel::fake();

        $this->get(route('admin.products.export'));

        Excel::assertQueued('products.xlsx', base_path('public/storage/exports/'));
    }
}
