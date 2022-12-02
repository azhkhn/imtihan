<?php

namespace Tests\Feature\Manager\User;

use App\Models\Company;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/user/students/';

    public function test_student_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $student = User::factory(20)->state(['role' => User::Student])->create();
        $student->each(function ($student) use ($company) {
            UserInfo::factory()->state(['user_id' => $student->id, 'company_id' => $company->id])->create();
        });

        Sanctum::actingAs($user, ['manager.user.student.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_student_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['company_id' => $company->id])->create();

        $student = [
            ...User::factory()->state(['role' => User::Student, 'password' => 'test'])->make()->toArray(),
            'password' => '12345678',
        ];

        Sanctum::actingAs($user, ['manager.user.student.create']);

        $response = $this->postJson($this->apiUrl, $student);
        $response->assertStatus(201);
    }

    public function test_student_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['company_id' => $company->id])->create();
        User::factory()->state(['role' => User::Student])->create();

        Sanctum::actingAs($user, ['manager.user.student.show']);

        $response = $this->get($this->apiUrl.$user->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $user->id]);
    }

    public function test_student_update()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['company_id' => $company->id])->create();
        User::factory()->state(['role' => User::Student])->create();

        Sanctum::actingAs($user, ['manager.user.student.update']);

        $response = $this->putJson($this->apiUrl.$user->id, [
            'full_name' => 'Test User',
        ]);
        $response->assertStatus(200);
    }

    public function test_student_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['company_id' => $company->id])->create();
        User::factory()->state(['role' => User::Student])->create();

        Sanctum::actingAs($user, ['manager.user.student.delete']);

        $response = $this->delete($this->apiUrl.$user->id);
        $response->assertStatus(200);
    }
}
