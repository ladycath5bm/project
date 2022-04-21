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

    /* public function testImportFile()
    {
        $file = new UploadedFile(base_path('tests/stubs/import.xlsx'), 'import.xlsx');

        $response = $this->post('admin/import', [
            'file' => $file,
        ]);

        $response->assertRedirect();
    } */
}
