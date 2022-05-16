<?php

namespace Tests\Feature\Admin\Imports;

use App\Exports\ProductsExport;
use App\Jobs\Exports\CompletExportStatusJob;
use App\Models\Export;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExcelExportProductsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed --class=RoleSeeder');
    }

    public function testUserCanQueueProductsExport()
    {
        Excel::fake();

        $user = User::factory()->create()->assignRole('admin');

        $data = [
            'start_date' => Carbon::now()->subDays(5)->toDateString(),
            'end_date' => now()->toDateString(),
            'category' => 'all',
            'status' => 'all',
        ];
        $name = 'products-' . now() . '.xlsx';

        $this->actingAs($user)
            ->get(route('admin.products.exports.generate', $data));

        Excel::assertQueued('public/exports/' . $name, function (ProductsExport $export) {
            return true;
        });

        Excel::assertQueuedWithChain([
            new CompletExportStatusJob(Export::find(1)),
        ]);
    }

    public function testUserCanStoreProductsExport()
    {
        $user = User::factory()->create()->assignRole('admin');

        Excel::fake();

        $data = [
            'start_date' => Carbon::now()->subDays(5)->toDateString(),
            'end_date' => now()->toDateString(),
            'category' => 'all',
            'status' => 'all',
        ];
        $name = 'products-' . now() . '.xlsx';

        $response = $this->actingAs($user)
            ->get(route('admin.products.exports.generate', $data));

        $response->assertRedirect();

        Excel::assertStored('public/exports/' . $name, function (ProductsExport $export) {
            return true;
        });
    }

    public function testUserCanDownloadProductsExport()
    {
        $user = User::factory()->create()->assignRole('admin');
        $name = 'products-' . now() . '.xlsx';
        $data = [
            'start_date' => Carbon::now()->subDays(5)->toDateString(),
            'end_date' => now()->toDateString(),
            'category' => 'all',
            'status' => 'all',
        ];

        $this->actingAs($user)
            ->get(route('admin.products.exports.generate', $data));

        $response = $this->actingAs($user)
            ->get(route('admin.products.exports.file'));

        $response->assertDownload($name);
    }
}
