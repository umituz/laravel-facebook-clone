<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Resources\FriendResource;
use Illuminate\Http\Request;

/**
 * Class FriendRequestResponseController
 * @package App\Http\Controllers
 */
class FriendRequestResponseController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'user_id' => '',
            'status' => ''
        ]);

        $friendRequest = Friend::where([
            'user_id' => $data['user_id'],
            'friend_id' => auth()->id()
        ])->firstOrFail();

        $data = array_merge($data, ['confirmed_at' => now()]);

        $friendRequest->update($data);

        return new FriendResource($friendRequest);
    }
}
