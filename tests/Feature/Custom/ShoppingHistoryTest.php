<?php

namespace Tests\Feature\Custom;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

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
