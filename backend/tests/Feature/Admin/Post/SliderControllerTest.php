<?php

namespace Tests\Feature\Admin\Post;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SliderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/post/sliders/';

    public function test_slider_list()
    {
        Slider::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.post.slider.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_slider_create()
    {
        $slider = Slider::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.post.slider.create']);

        $response = $this->postJson($this->apiUrl, $slider->toArray());
        $response->assertStatus(201);
    }

    public function test_slider_show()
    {
        $slider = Slider::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.post.slider.show']);

        $response = $this->get($this->apiUrl.$slider->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $slider->id]);
    }

    public function test_slider_update()
    {
        $slider = Slider::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.post.slider.update']);

        $response = $this->putJson($this->apiUrl.$slider->id, [
            'name' => 'New Title',
        ]);
        $response->assertStatus(200);
    }

    public function test_slider_delete()
    {
        $slider = Slider::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.post.slider.delete']);

        $response = $this->deleteJson($this->apiUrl.$slider->id);
        $response->assertStatus(200);
    }
}
