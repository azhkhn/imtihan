<?php

namespace Tests\Feature\Teacher\Booking;

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

    protected string $apiUrl = '/api/teacher/bookings/';

    public function test_booking_list()
    {
        $company = Company::factory()->create();
        $teacher = User::factory()->state(['role' => User::Teacher])->create();
        UserInfo::factory()->state(['user_id' => $teacher->id, 'company_id' => $company->id])->create();
        $student = User::factory()->state(['role' => User::Student])->create();
        UserInfo::factory()->state(['user_id' => $student->id, 'company_id' => $company->id])->create();
        Booking::factory(20)->state(['company_id' => $company->id, 'teacher_id' => $teacher->id, 'user_id' => $student->id])->create();

        Sanctum::actingAs($teacher, ['teacher.booking.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_booking_show()
    {
        $company = Company::factory()->create();
        $teacher = User::factory()->state(['role' => User::Teacher])->create();
        UserInfo::factory()->state(['user_id' => $teacher->id, 'company_id' => $company->id])->create();
        $student = User::factory()->state(['role' => User::Student])->create();
        UserInfo::factory()->state(['user_id' => $student->id, 'company_id' => $company->id])->create();
        $booking = Booking::factory()->state(['company_id' => $company->id, 'teacher_id' => $teacher->id, 'user_id' => $student->id])->create();

        Sanctum::actingAs($teacher, ['teacher.booking.show']);

        $response = $this->get($this->apiUrl.$booking->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $booking->id]);
    }

    public function test_booking_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Teacher])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $booking = Booking::factory()->state(['company_id' => $company->id, 'teacher_id' => $user->id])->create();

        Sanctum::actingAs($user, ['teacher.booking.delete']);

        $response = $this->delete($this->apiUrl.$booking->id);
        $response->assertStatus(200);
    }
}
