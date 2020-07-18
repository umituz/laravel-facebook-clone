<?php

namespace App\Http\Controllers;

use App\Exceptions\RecordNotFoundException;
use App\Friend;
use App\Http\Resources\FriendResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        try {
            $friendRequest = Friend::where([
                'user_id' => $data['user_id'],
                'friend_id' => auth()->id()
            ])->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw new RecordNotFoundException();
        }

        $data = array_merge($data, ['confirmed_at' => now()]);

        $friendRequest->update($data);

        return new FriendResource($friendRequest);
    }
}
