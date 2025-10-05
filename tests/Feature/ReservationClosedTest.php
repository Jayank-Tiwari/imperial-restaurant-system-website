<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Carbon;

class ReservationClosedTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::parse('next wednesday'));
    }

    public function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_reservation_blocked_on_wednesday()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('booking.store'), [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'reservation_date' => now()->addDay()->toDateString(),
                'reservation_time' => '18:00',
                'guests' => 2,
            ]);

        $response->assertSessionHas('error');
    }
}
