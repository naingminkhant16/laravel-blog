@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Posts</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">Manage Posts</h4>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        <hr>
        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        @notAuthor
                        <th>Owner</th>
                        @endnotAuthor
                        <th>Category</th>
                        <th>Body</th>
                        <th>Actions</th>
                        <th>Created At</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td class="">
                            <div class="">
                                @isset($post->image)
                                <img src="{{asset('storage/imgs/'.$post->image)}}" height="70" class="mb-1 rounded"
                                    alt="">
                                @endisset
                                <div class="">
                                    {{$post->title}}
                                    {{-- <span class="badge bg-secondary">{{$post->slug}}</span> --}}
                                </div>
                            </div>
                        </td>
                        @notAuthor
                        <td>{{$post->author->name}}</td>
                        @endnotAuthor
                        <td>{{$post->category->title}}</td>
                        <td class="">{{Str::words($post->body,10)}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('post.show',$post->id)}}" class="btn me-1 btn-outline-dark btn-sm"><i
                                        class="bi bi-info-circle"></i></a>
                                <a href="{{route('post.edit',$post->id)}}" class="btn me-1 btn-outline-dark btn-sm"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{route('post.destroy',$post->id)}}" id="del{{$post->id}}" class="d-none"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button onclick="confirmDelete({{$post->id}})" class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-trash3"></i></button>
                            </div>
                        </td>
                        <td class="text-black-50">
                            <i class="bi bi-calendar"></i> {{$post->created_at->format('d/m/y')}}
                            <br>
                            <i class="bi bi-clock">{{$post->created_at->format('H:00 A')}}</i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection
