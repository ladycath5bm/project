<?php

namespace Tests\Feature\Admin\Imports;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportFileTest extends TestCase
{
    protected function setUp(): void
        {
            parent::setUp();

            $user = User::factory()->create();
            $user->assignRole('admin');
            Sanctum::actingAs($user);
        }
        
    public function testImportFile()
    {

        $file = new UploadedFile(base_path('tests/stubs/import.xlsx'), 'import.xlsx');

        $response = $this->post('admin/import', [
            'file' => $file,
        ]);

        $response->assertRedirect();
    }
}
