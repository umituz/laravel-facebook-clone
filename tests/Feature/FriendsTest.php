<?php

namespace Tests\Feature;

use App\Friend;
use App\Http\Traits\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class FriendsTest
 * @package Tests\Feature
 */
class FriendsTest extends TestCase
{
    use RefreshDatabase, TestTrait;

    /**
     * @test
     */
    public function a_user_can_send_a_friend_request()
    {
        $this->withoutExceptionHandling();

        $user = $this->user();
        $this->actingAs($user, 'api');

        $anotherUser = $this->user();

        $response = $this->post('/api/friend-request', [
            'friend_id' => $anotherUser->id
        ])->assertStatus(200);

        $friendRequest = Friend::first();

        $this->assertNotNull($friendRequest);
        $this->assertEquals($anotherUser->id, $friendRequest->friend_id);
        $this->assertEquals($user->id, $friendRequest->user_id);

        $response->assertJson([
            'data' => [
                'type' => 'friend-request',
                'friend_request_id' => $friendRequest->id,
                'attributes' => [
                    'confirmed_at' => null
                ]
            ],
            'links' => [
                'self' => url('/users/' . $anotherUser->id)
            ]
        ]);

    }

    /**
     * @test
     */
    public function only_valid_user_can_be_friend_requested()
    {
//        $this->withoutExceptionHandling();

        $user = $this->user();
        $this->actingAs($user, 'api');

        $response = $this->post('/api/friend-request', [
            'friend_id' => 123
        ])->assertStatus(404);

        $friendRequest = Friend::first();

        $this->assertNull($friendRequest);

        $response->assertJson([
            'errors' => [
                'code' => 404,
                'title' => 'Record Not Found',
                'detail' => 'Unable to locate the record with the given information'
            ]
        ]);
    }
}
