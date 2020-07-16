<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Resources\FriendResource;
use App\User;

/**
 * Class FriendRequestController
 * @package App\Http\Controllers
 */
class FriendRequestController extends Controller
{
    /**
     * Store data
     *
     * @return FriendResource
     */
    public function store()
    {
        $data = request()->validate([
            'friend_id' => ''
        ]);

        User::find($data['friend_id'])->friends()->attach(auth()->user());

        $friend = Friend::where(['user_id' => auth()->id(), 'friend_id' => $data['friend_id']])->first();

        return new FriendResource($friend);
    }
}
