<?php

namespace Tests\Feature\Manager\Booking;

use App\Models\BookingSetting;
use App\Models\Company;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookingSettingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/booking/settings/';

    public function test_booking_setting_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        BookingSetting::factory(20)->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.booking-setting.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_booking_setting_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $bookingSetting = BookingSetting::factory()->state(['company_id' => $company->id])->make();

        Sanctum::actingAs($user, ['manager.booking-setting.create']);

        $response = $this->postJson($this->apiUrl, $bookingSetting->toArray());
        $response->assertStatus(201);
    }

    public function test_booking_setting_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $bookingSetting = BookingSetting::factory()->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.booking-setting.show']);

        $response = $this->get($this->apiUrl.$bookingSetting->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $bookingSetting->id]);
    }

    public function test_booking_setting_update()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $bookingSetting = BookingSetting::factory()->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.booking-setting.update']);

        $response = $this->putJson($this->apiUrl.$bookingSetting->id, [
            'ignore_date' => '2021-01-01',
        ]);
        $response->assertStatus(200);
    }

    public function test_booking_setting_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $bookingSetting = BookingSetting::factory()->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.booking-setting.delete']);

        $response = $this->delete($this->apiUrl.$bookingSetting->id);
        $response->assertStatus(200);
    }
}
