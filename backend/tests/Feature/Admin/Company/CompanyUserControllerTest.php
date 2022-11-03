<?php

namespace Tests\Feature\Admin\Company;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CompanyUserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/company/users/';

    public function test_company_user_list()
    {
        $user = User::factory()->create();
        User::factory(20)->state(['role' => User::Manager])->create();

        Sanctum::actingAs($user, ['admin.company.user.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_company_user_create()
    {
        $user = User::factory()->create();

        $companyUser = [
            ...User::factory()->state(['role' => User::Manager, 'password' => 'test'])->make()->toArray(),
            'password' => '12345678',
        ];

        Sanctum::actingAs($user, ['admin.company.user.create']);

        $response = $this->postJson($this->apiUrl, $companyUser);
        $response->assertStatus(201);
    }

    public function test_company_user_show()
    {
        $user = User::factory()->create();
        $companyUser = User::factory()->state(['role' => User::Manager])->create();

        Sanctum::actingAs($user, ['admin.company.user.show']);

        $response = $this->get($this->apiUrl.$companyUser->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $companyUser->id]);
    }

    public function test_company_user_update()
    {
        $user = User::factory()->create();
        $companyUser = User::factory()->state(['role' => User::Manager])->create();

        Sanctum::actingAs($user, ['admin.company.user.update']);

        $response = $this->putJson($this->apiUrl.$companyUser->id, [
            'full_name' => 'Test User',
        ]);
        $response->assertStatus(200);
    }

    public function test_company_user_delete()
    {
        $user = User::factory()->create();
        $companyUser = User::factory()->state(['role' => User::Manager])->create();

        Sanctum::actingAs($user, ['admin.company.user.delete']);

        $response = $this->delete($this->apiUrl.$companyUser->id);
        $response->assertStatus(200);
    }
}
