<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(Auth::user()->isAuthor(), fn ($q) => $q->where('user_id', Auth::id()))->where(function ($q) {
            $q->when(request('search'), function ($q, $search) {
                $q->where('title', "like", "%" . $search . "%")
                    ->orWhere('body', 'like', "%" . $search . "%");
            });
        })
            ->with(['author', 'category'])
            ->latest('id')->paginate(10)->withQueryString();
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        if ($request->hasFile('image')) {
            $newName = uniqid() . "_featured_image." . $request->file('image')->extension();
            $request->file('image')->storeAs('public/imgs', $newName);
            $post->image = $newName;
        }
        $post->save();

        //saving post photos
        foreach ($request->photos as $photo) {
            //save photo to storage
            $newName = uniqid() . "_post_photos." . $photo->extension();
            $photo->storeAs('public/imgs', $newName);
            //save to db
            $photo = new Photo();
            $photo->post_id = $post->id;
            $photo->name = $newName;
            $photo->save();
        }

        return redirect()->route('post.index')->with('status', $post->title . ' is successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        Gate::authorize('view', $post);
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('view', $post);
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        // $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if ($request->hasFile('image')) {
            Storage::delete('public/imgs/' . $post->image);
            $newName = uniqid() . "_featured_image." . $request->file('image')->extension();
            $request->file('image')->storeAs('public/imgs', $newName);
            $post->image = $newName;
        }
        $post->update();
        return redirect()->route('post.index')->with('status', $post->title . " is successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $deletedPostTitle = $post->title;
        Gate::authorize('delete', $post);
        if ($post->image) {
            Storage::delete('public/imgs/' . $post->image);
        }
        $post->delete();
        return redirect()->route('post.index')->with('status', $deletedPostTitle . ' is successfully deleted.');
    }
}
