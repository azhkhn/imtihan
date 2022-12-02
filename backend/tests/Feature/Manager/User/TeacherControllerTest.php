<?php

namespace Tests\Feature\Manager\User;

use App\Models\Company;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeacherControllerTest extends TestCase
{
    //use RefreshDatabase;

    protected string $apiUrl = '/api/manager/user/teachers/';

    public function test_teacher_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id,'company_id' => $company->id])->create();
        $student = User::factory(20)->state(['role' => User::Teacher])->create();
        $student->each(function ($student) use ($company) {
            UserInfo::factory()->state(['user_id' => $student->id ,'company_id' => $company->id])->create();
        });

        Sanctum::actingAs($user, ['manager.user.teacher.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_teacher_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['company_id' => $company->id])->create();

        $teacher = [
            ...User::factory()->state(['role' => User::Teacher, 'password' => 'test'])->make()->toArray(),
            'password' => '12345678',
        ];

        Sanctum::actingAs($user, ['manager.user.teacher.create']);

        $response = $this->postJson($this->apiUrl, $teacher);
        $response->assertStatus(201);
    }

    public function test_teacher_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['company_id' => $company->id])->create();
        User::factory()->state(['role' => User::Teacher])->create();

        Sanctum::actingAs($user, ['manager.user.teacher.show']);

        $response = $this->get($this->apiUrl.$user->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $user->id]);
    }

    public function test_teacher_update()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['company_id' => $company->id])->create();
        User::factory()->state(['role' => User::Teacher])->create();

        Sanctum::actingAs($user, ['manager.user.teacher.update']);

        $response = $this->putJson($this->apiUrl.$user->id, [
            'full_name' => 'Test User',
        ]);
        $response->assertStatus(200);
    }

    public function test_teacher_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['company_id' => $company->id])->create();
        User::factory()->state(['role' => User::Teacher])->create();

        Sanctum::actingAs($user, ['manager.user.teacher.delete']);

        $response = $this->delete($this->apiUrl.$user->id);
        $response->assertStatus(200);
    }
}
