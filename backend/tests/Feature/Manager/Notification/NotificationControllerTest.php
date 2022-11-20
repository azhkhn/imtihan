<?php

namespace Tests\Feature\Manager\Notification;

use App\Models\Company;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class NotificationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/notifications/';

    public function test_notification_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        Notification::factory(20)->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.notification.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_lesson_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $notification = Notification::factory()->make();

        Sanctum::actingAs($user, ['manager.notification.create']);

        $response = $this->postJson($this->apiUrl, $notification->toArray());

        $response->assertStatus(201);
    }
}
