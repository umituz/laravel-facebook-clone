<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FriendResource
 * @package App\Http\Resources
 */
class FriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'friend-request',
                'friend_request_id' => $this->id,
                'attributes' => [
                    'confirmed_at' => $this->confirmed_at
                ]
            ],
            'links' => [
                'self' => url('/users/' . $this->friend_id)
            ]
        ];
    }
}
