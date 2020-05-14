<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class PostToTimelineTest
 * @package Tests\Feature
 */
class PostToTimelineTest extends TestCase
{
    use RefreshDatabase;

    private function user()
    {
        return factory(User::class)->create();
    }

    /**
     * @test
     */
    public function a_user_can_post_a_text_post()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user(), 'api');

        $response = $this->post('/api/posts', [
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'body' => 'Testing Body'
                ]
            ]
        ]);

        $post = Post::first();

        $response->assertStatus(201);
    }
}
