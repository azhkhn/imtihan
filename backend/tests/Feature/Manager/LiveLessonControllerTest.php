<?php

namespace Tests\Feature\Manager;

use App\Models\Company;
use App\Models\LiveLesson;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LiveLessonControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/live-lessons/';

    public function test_live_lesson_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        LiveLesson::factory(20)->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.live-lesson.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_live_lesson_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $liveLesson = LiveLesson::factory()->state(['company_id' => $company->id])->make();

        Sanctum::actingAs($user, ['manager.live-lesson.create']);

        $response = $this->postJson($this->apiUrl, $liveLesson->toArray());
        $response->assertStatus(201);
    }

    public function test_live_lesson_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $liveLesson = LiveLesson::factory()->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.live-lesson.show']);

        $response = $this->get($this->apiUrl.$liveLesson->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $liveLesson->id]);
    }

    public function test_live_lesson_update()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $liveLesson = LiveLesson::factory()->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.live-lesson.update']);

        $response = $this->putJson($this->apiUrl.$liveLesson->id, $liveLesson->toArray());
        $response->assertStatus(200);
    }

    public function test_live_lesson_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $liveLesson = LiveLesson::factory()->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.live-lesson.delete']);

        $response = $this->delete($this->apiUrl.$liveLesson->id);
        $response->assertStatus(200);
    }
}
