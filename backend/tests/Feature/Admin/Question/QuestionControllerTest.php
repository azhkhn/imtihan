<?php

namespace Tests\Feature\Admin\Question;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{

    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/questions/';

    public function test_question_list()
    {
        Question::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.question.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_question_create()
    {
        $question = Question::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.question.create']);

        $response = $this->postJson($this->apiUrl, $question->toArray());
        $response->assertStatus(201);
    }

    public function test_question_show()
    {
        $question = Question::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.question.show']);

        $response = $this->get($this->apiUrl . $question->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $question->id]);
    }

    public function test_question_update()
    {
        $question = Question::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.question.update']);

        $response = $this->putJson($this->apiUrl . $question->id, [
            'name' => "Test Question",
            'description' => "Test Question Description",
        ]);
        $response->assertStatus(200);
    }

    public function test_question_delete()
    {
        $question = Question::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.question.delete']);

        $response = $this->delete($this->apiUrl . $question->id);
        $response->assertStatus(200);
    }
}
