<?php

namespace Tests\Feature\Admin\Announcement;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AnnouncementControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/announcements/';

    public function test_announcement_list()
    {
        Announcement::factory(20)->state(['company_id' => null])->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.announcement.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_announcement_create()
    {
        $announcement = Announcement::factory()->state(['company_id' => null])->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.announcement.create']);

        $response = $this->postJson($this->apiUrl, $announcement->toArray());
        $response->assertStatus(201);
    }

    public function test_announcement_show()
    {
        $announcement = Announcement::factory()->state(['company_id' => null])->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.announcement.show']);

        $response = $this->get($this->apiUrl.$announcement->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $announcement->id]);
    }

    public function test_announcement_update()
    {
        $announcement = Announcement::factory()->state(['company_id' => null])->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.announcement.update']);

        $response = $this->putJson($this->apiUrl.$announcement->id, [
            'name' => 'New Title',
            'content' => 'New Content',
        ]);
        $response->assertStatus(200);
    }

    public function test_announcement_delete()
    {
        $announcement = Announcement::factory()->state(['company_id' => null])->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.announcement.delete']);

        $response = $this->deleteJson($this->apiUrl.$announcement->id);
        $response->assertStatus(200);
    }
}
