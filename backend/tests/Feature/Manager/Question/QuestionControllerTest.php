<?php

namespace Tests\Feature\Manager\Question;

use App\Models\Company;
use App\Models\Question;
use App\Models\QuestionByCompany;
use App\Models\QuestionOption;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/manager/questions/';

    public function test_question_list()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $question = QuestionByCompany::factory(20)->state(['company_id' => $company->id])->create();
        $question->each(function ($question) {
            QuestionOption::factory(4)->state(['question_id' => $question->question_id])->create();
        });

        Sanctum::actingAs($user, ['manager.question.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_question_create()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $question = Question::factory()->make();
        $options =  QuestionOption::factory(4)->state(['question_id' => $question->question_id])->make();

        $data = [
            ...$question->toArray(),
            'options' => $options->toArray(),
        ];

        Sanctum::actingAs($user, ['manager.question.create']);

        $response = $this->postJson($this->apiUrl, $data);
        $response->assertStatus(201);
    }

    public function test_question_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $question = QuestionByCompany::factory()->state(['company_id' => $company->id])->create();
        $question->each(function ($question) {
            QuestionOption::factory(4)->state(['question_id' => $question->question_id])->create();
        });

        Sanctum::actingAs($user, ['manager.question.show']);

        $response = $this->get($this->apiUrl.$question->question_id);

        Log::info($response->getContent());

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(4, 'data.options');
    }

    public function test_question_update()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $question = QuestionByCompany::factory()->state(['company_id' => $company->id])->create();
        $question->each(function ($question) {
            QuestionOption::factory(4)->state(['question_id' => $question->question_id])->create();
        });

        $newQuestion = Question::factory()->make();
        $options =  QuestionOption::factory(4)->state(['question_id' => $newQuestion->question_id])->make();

        $data = [
            ...$newQuestion->toArray(),
            'options' => $options->toArray(),
        ];

        Sanctum::actingAs($user, ['manager.question.update']);

        $response = $this->putJson($this->apiUrl.$question->question_id, $data);

        $response->assertStatus(200);
    }

    public function test_question_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->state(['role' => User::Manager])->create();
        UserInfo::factory()->state(['user_id' => $user->id, 'company_id' => $company->id])->create();
        $question = QuestionByCompany::factory()->state(['company_id' => $company->id])->create();
        $question->each(function ($question) {
            QuestionOption::factory(4)->state(['question_id' => $question->question_id])->create();
        });

        Sanctum::actingAs($user, ['manager.question.delete']);

        $response = $this->delete($this->apiUrl.$question->question_id);

        $response->assertStatus(200);
    }
}
