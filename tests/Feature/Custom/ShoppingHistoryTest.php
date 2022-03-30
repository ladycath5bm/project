<?php

namespace Tests\Feature\Custom;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShoppingHistoryTest extends TestCase
{
    protected function setUp(): void
    {
            parent::setUp();
            
            $user = User::factory()->create();
            $user->assignRole('custom');
            Sanctum::actingAs($user);
         
    }
   
    public function testYouCanSeeYourShoppingHistory(): void
    {
        $response = $this->get(route('/shophistory'));

        $response->assertOk();
        $response->assertViewIs('shophistory');
    }
}