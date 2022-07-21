<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function __invoke()
    {
        return PostResource::collection(Post::latest()->get());
    }
}
