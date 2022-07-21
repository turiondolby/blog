<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\PostResource;

class PostIndexController extends Controller
{
    public function __invoke()
    {
        return PostResource::collection(Post::latest()->whereNotNull('published_at')->get());
    }
}
