<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * Returns all posts
     *
     * @return PostCollection
     */
    public function index()
    {
        $posts = request()->user()->posts;
        return new PostCollection($posts);
    }

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
