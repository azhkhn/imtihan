<?php

namespace Tests\Feature\User\Booking;

use App\Models\Booking;
use App\Models\Company;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/user/bookings/';

    public function test_booking_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Student])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        Booking::factory(20)->state(['company_id' => $company->id, 'user_id' => $user->id])->create();

        Sanctum::actingAs($user, ['user.booking.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_booking_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Student])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $booking = Booking::factory()->make();

        Sanctum::actingAs($user, ['user.booking.create']);

        $response = $this->postJson($this->apiUrl, $booking->toArray());
        $response->assertStatus(201);
    }
}
