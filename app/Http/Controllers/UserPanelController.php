<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class UserPanelController extends Controller
{
    public function index()
    {
        $posts = Post::when(request('search'), function ($q, $search) {
            $q->where('title', "like", "%" . $search . "%")
                ->orWhere('body', 'like', "%" . $search . "%");
        })
            ->with(['author', 'category'])
            ->latest('id')->paginate(5)->withQueryString();

        return view('welcome', ['posts' => $posts]);
    }

    public function detail(Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    public function cat(Category $category)
    {
        $posts = Post::when(request('search'), function ($q, $search) {
            $q->where(function ($q) use ($search) {
                $q->where('title', "like", "%" . $search . "%")
                    ->orWhere('body', 'like', "%" . $search . "%");
            });
        })
            ->where('category_id', $category->id)
            ->with(['author', 'category'])
            ->latest('id')->paginate(5)->withQueryString();
        return view('welcome', ['posts' => $posts, 'category' => $category]);
    }
}
