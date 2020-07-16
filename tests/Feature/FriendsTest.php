<?php

namespace Tests\Feature;

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

        $this->post('/api/friend-request', [
            'friend_id' => $anotherUser->id
        ])->assertStatus(200);


    }
}
