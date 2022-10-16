<?php

namespace Tests\Feature\Admin;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ClassRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/class-rooms/';

    public function test_class_room_list()
    {
        ClassRoom::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.class-room.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_class_room_create()
    {
        $classRoom = ClassRoom::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.class-room.create']);

        $response = $this->postJson($this->apiUrl, $classRoom->toArray());
        $response->assertStatus(201);
    }

    public function test_class_room_show()
    {
        $classRoom = ClassRoom::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.class-room.show']);

        $response = $this->get($this->apiUrl.$classRoom->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $classRoom->id]);
    }

    public function test_class_room_update()
    {
        $classRoom = ClassRoom::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.class-room.update']);

        $response = $this->putJson($this->apiUrl.$classRoom->id, [
            'name' => 'Test',
        ]);
        $response->assertStatus(200);
    }

    public function test_class_room_delete()
    {
        $classRoom = ClassRoom::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.class-room.delete']);

        $response = $this->deleteJson($this->apiUrl.$classRoom->id);
        $response->assertStatus(200);
    }
}
