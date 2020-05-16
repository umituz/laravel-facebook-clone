<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * Stores data
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'data.attributes.body' => ''
        ]);

        $data = $data['data']['attributes'];

        $post = request()->user()->posts()->create($data);

        return new PostResource($post);
    }
}
