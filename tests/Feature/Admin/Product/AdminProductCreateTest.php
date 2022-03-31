<?php

namespace Tests\Feature\Admin\Product;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Tests\TestCase;

class AdminProductCreateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $user->assignRole('admin');
        Sanctum::actingAs($user);
    }

    public function testItVisitCreateproduct(): void
    {
        $response = $this->get(route('admin.products.create'));

        $response->assertOk();
        $response->assertViewIs('admin.products.create');
    }

    public function testItCreateProducts(): void
    {
        $response = $this->get(route('admin.products.create'));

        $response->assertViewIs('admin.products.create');
        //$response->assertViewHas();
    }

    public function testYouCanSeeCreateProductAndSeeLog()
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

        $this->testItVisitCreateproduct();

        //$monolog->getHandlers();
    }
}
