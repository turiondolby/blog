<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\PostResource;

class PostShowController extends Controller
{
    public function __invoke(Post $post)
    {
        //authorize

        return new PostResource($post);
    }
}
