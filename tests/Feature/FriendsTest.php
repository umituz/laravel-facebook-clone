<?php

namespace Tests\Feature;

use App\Friend;
use App\Http\Traits\TestTrait;
use Carbon\Carbon;
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

    /**
     * @test
     */
    public function friend_requests_can_be_accepted()
    {
        $this->withoutExceptionHandling();

        $user = $this->user();
        $this->actingAs($user, 'api');

        $anotherUser = $this->user();

        $this->post('/api/friend-request', [
            'friend_id' => $anotherUser->id
        ])->assertStatus(200);

        $response = $this->actingAs($anotherUser, 'api')
            ->post('/api/friend-request-response', [
                'user_id' => $user->id,
                'status' => 1
            ]);

        $friendRequest = Friend::first();

        $this->assertNotNull($friendRequest->confirmed_at);
        $this->assertInstanceOf(Carbon::class, $friendRequest->confirmed_at);
        $this->assertEquals(now()->startOfSecond(), $friendRequest->confirmed_at);
        $this->assertEquals(1, $friendRequest->status);

        $response->assertJson([
            'data' => [
                'type' => 'friend-request',
                'friend_request_id' => $friendRequest->id,
                'attributes' => [
                    'confirmed_at' => $friendRequest->confirmed_at->diffForHumans()
                ]
            ],
            'links' => [
                'self' => url('/users/' . $anotherUser->id)
            ]
        ]);

    }
}
