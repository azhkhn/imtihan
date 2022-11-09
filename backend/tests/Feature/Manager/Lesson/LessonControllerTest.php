<?php

namespace Tests\Feature\Manager\Lesson;

use App\Models\Company;
use App\Models\Lesson;
use App\Models\LessonByCompany;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/lessons/';

    public function test_lesson_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        LessonByCompany::factory(20)->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.lesson.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_lesson_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $lesson = Lesson::factory()->make();

        Sanctum::actingAs($user, ['manager.lesson.create']);

        $response = $this->postJson($this->apiUrl, $lesson->toArray());

        $response->assertStatus(201);
    }

    /*public function test_lesson_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $lesson = LessonByCompany::factory()->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.lesson.show']);

        $response = $this->get($this->apiUrl.$lesson->lesson_id);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $lesson->lesson_id]);
    }*/
    //TODO: test_lesson_show Call to undefined relationship [company_id] on model [App\Models\LessonByCompany].

    public function test_lesson_update()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $lesson = LessonByCompany::factory()->state(['company_id' => $company->id])->create();

        $newLesson = Lesson::factory()->make();

        $data = [
            ...$newLesson->toArray(),
        ];

        Sanctum::actingAs($user, ['manager.lesson.update']);

        $response = $this->putJson($this->apiUrl.$lesson->lesson_id, $data);

        $response->assertStatus(200);
    }

    public function test_lesson_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $lesson = LessonByCompany::factory()->state(['company_id' => $company->id])->create();

        Sanctum::actingAs($user, ['manager.lesson.delete']);

        $response = $this->delete($this->apiUrl.$lesson->lesson_id);

        $response->assertStatus(200);
    }
}
