<?php

namespace Tests\Feature\Manager\Booking;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/bookings/';

    public function test_booking_list()
    {
        Booking::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['manager.booking.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_booking_create()
    {
        $booking = Booking::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['manager.booking.create']);

        $response = $this->postJson($this->apiUrl, $booking->toArray());
        $response->assertStatus(201);
    }

    public function test_booking_show()
    {
        $booking = Booking::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['manager.booking.show']);

        $response = $this->get($this->apiUrl.$booking->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $booking->id]);
    }

    public function test_booking_update()
    {
        $booking = Booking::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['manager.booking.update']);

        $response = $this->putJson($this->apiUrl.$booking->id, [
            'ignore_date' => '2021-01-01',
        ]);
        $response->assertStatus(200);
    }

    public function test_booking_delete()
    {
        $booking = Booking::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['manager.booking.delete']);

        $response = $this->delete($this->apiUrl.$booking->id);
        $response->assertStatus(200);
    }
}
