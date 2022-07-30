<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\PostResource;

class PostShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $this->authorize('show', $post);

        return new PostResource($post);
    }
}
