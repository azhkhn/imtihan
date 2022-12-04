<?php

namespace Tests\Feature\Manager\Exam;

use App\Models\Company;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ExamResultCategory;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/exam/reports/';

    public function test_report_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $student = User::factory()->state(['role' => User::Student])->create();

        $category = QuestionCategory::factory(2)->create();
        $exam = Exam::factory()->create(['user_id' => $student->id]);
        $category->each(function ($category) use ($exam, $student) {
            $questions = Question::factory(5)->state(['category_id' => $category->id])->create();
            ExamResultCategory::factory()->state([
                'total_questions' => $questions->count(),
                'correct' => 3,
                'in_correct' => 1,
                'blank' => 1,
                'exam_id' => $exam->id,
                'category_id' => $category->id,
                'user_id' => $student->id,
            ])->create();
        });

        ExamResult::factory()->state([
            'exam_id' => $exam->id,
            'user_id' => $student->id,
            'company_id' => $company->id,
            'total_questions' => 10,
            'correct' => 6,
            'in_correct' => 2,
            'blank' => 2,
            'point' => 50,
        ])->create();

        Sanctum::actingAs($user, ['manager.exam.report.list']);

        $response = $this->get($this->apiUrl);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(1, 'data');
    }

    public function test_report_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $student = User::factory()->state(['role' => User::Student])->create();

        $category = QuestionCategory::factory(2)->create();
        $exam = Exam::factory()->create(['user_id' => $student->id]);
        $category->each(function ($category) use ($exam, $student) {
            $questions = Question::factory(5)->state(['category_id' => $category->id])->create();
            ExamResultCategory::factory()->state([
                'total_questions' => $questions->count(),
                'correct' => 3,
                'in_correct' => 1,
                'blank' => 1,
                'exam_id' => $exam->id,
                'category_id' => $category->id,
                'user_id' => $student->id,
            ])->create();
        });

        ExamResult::factory()->state([
            'exam_id' => $exam->id,
            'user_id' => $student->id,
            'company_id' => $company->id,
            'total_questions' => 10,
            'correct' => 6,
            'in_correct' => 2,
            'blank' => 2,
            'point' => 50,
        ])->create();

        Sanctum::actingAs($user, ['manager.exam.report.show']);

        $response = $this->get($this->apiUrl.$exam->id);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(2, 'data.categories');
    }
}
