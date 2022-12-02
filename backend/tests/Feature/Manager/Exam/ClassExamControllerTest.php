<?php

namespace Tests\Feature\Manager\Exam;

use App\Models\ClassExam;
use App\Models\ClassExamCategory;
use App\Models\Company;
use App\Models\QuestionCategory;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ClassExamControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/exam/classes/';

    public function test_class_exam_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $category = QuestionCategory::factory()->create();
        $classExams = ClassExam::factory(20)->state(['company_id' => $company->id])->create();
        $classExams->each(function ($classExam) use ($category) {
            ClassExamCategory::factory()->state(['class_exam_id' => $classExam->id, 'category_id' => $category->id])->create();
        });

        Sanctum::actingAs($user, ['manager.class-exam.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_class_exam_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $category = QuestionCategory::factory()->create();
        $classExam = ClassExam::factory()->create();
        $classExamCategories = ClassExamCategory::factory(4)->state(['class_exam_id' => $classExam->id, 'category_id' => $category->id])->make();

        $data = [
            ...$classExam->toArray(),
            'categories' => $classExamCategories->toArray(),
        ];

        Sanctum::actingAs($user, ['manager.class-exam.create']);

        $response = $this->postJson($this->apiUrl, $data);
        $response->assertStatus(201);
    }

    public function test_class_exam_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $category = QuestionCategory::factory()->create();
        $classExam = ClassExam::factory()->create();
        ClassExamCategory::factory(4)->state(['class_exam_id' => $classExam->id, 'category_id' => $category->id])->create();

        Sanctum::actingAs($user, ['manager.class-exam.show']);

        $response = $this->get($this->apiUrl.$classExam->id);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $classExam->id]);
    }

    public function test_class_exam_update()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $category = QuestionCategory::factory()->create();
        $classExam = ClassExam::factory()->create();
        $classExamCategories = ClassExamCategory::factory(4)->state(['class_exam_id' => $classExam->id, 'category_id' => $category->id])->make();

        $data = [
            ...$classExam->toArray(),
            'categories' => $classExamCategories->toArray(),
        ];

        Sanctum::actingAs($user, ['manager.class-exam.update']);

        $response = $this->putJson($this->apiUrl.$classExam->id, $data);
        $response->assertStatus(200);
    }

    public function test_class_exam_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $category = QuestionCategory::factory()->create();
        $classExam = ClassExam::factory()->create();
        ClassExamCategory::factory(4)->state(['class_exam_id' => $classExam->id, 'category_id' => $category->id])->create();

        Sanctum::actingAs($user, ['manager.class-exam.delete']);

        $response = $this->delete($this->apiUrl.$classExam->id);

        $response->assertStatus(200);
    }
}
