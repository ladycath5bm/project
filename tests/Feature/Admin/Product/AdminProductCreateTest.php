<?php

namespace Tests\Feature\Admin\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Tests\TestCase;

class AdminProductCreateTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
    }

    public function testItCanVisitAndFormCreateproduct(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.products.create'));

        $response->assertOk();
        $response->assertViewIs('admin.products.create');
    }

    public function testYouCanSeeCreateProductAndSeeLog(): void
    {
        $monolog = new Logger('test');
        $monolog->pushHandler(new TestHandler());
        config([
            'default' => 'test',
            'logging.channels' => [
                'test' => [
                    'driver' => 'custom',
                    'via' => $monolog,
                ],
            ],
        ]);

        $this->testItCanVisitAndFormCreateproduct();
    }
}
