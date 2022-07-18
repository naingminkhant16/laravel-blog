<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        $posts = Post::when(request('search'), function ($q, $search) {
            $q->where('title', "like", "%" . $search . "%")
                ->orWhere('body', 'like', "%" . $search . "%");
        })
            ->with(['author', 'category'])
            ->latest('id')->paginate(5)->withQueryString();

        return response()->json($posts);
    }

    public function detail(Post $post)
    {
        return response()->json($post->load(['photos', 'author', 'category']));
    }
}
