<?php

namespace Tests\Feature\Admin\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminProductCreateTest extends TestCase
{
    use RefreshDatabase;
    
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

<<<<<<< HEAD
        $user = User::factory()->create();  
        //$role = Role::create(['name' => 'admin']);
        //$user->assignRole('admin');
        Sanctum::actingAs($user);
=======
        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create()->assignRole('admin');
>>>>>>> develop
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
