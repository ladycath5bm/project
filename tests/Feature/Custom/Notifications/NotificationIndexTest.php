<?php

namespace Tests\Feature\Custom\Notifications;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationIndexTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testItCanSeeListOfNotifications()
    {
        $response = $this->actingAs($this->user)
            ->get(route('notifications.index'));

        $response->assertViewis('notifications.index');
    }
}
