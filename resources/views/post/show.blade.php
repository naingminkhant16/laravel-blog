@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('post.index')}}">Posts</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center fw-bold">{{$post->title}}</h4>
        <hr>
        <div class="container">
            @isset($post->image)
            <div class="d-flex justify-content-center mb-3">
                <img src="{{asset('storage/imgs/'.$post->image)}}" class="rounded" height="300">
            </div>
            @endisset
            <div class="mb-3 text-center">
                <span class="badge bg-dark"><i class="me-1 bi bi-grid"></i>{{$post->category->title}}</span>
                <span class="badge bg-dark"><i class="me-1 bi bi-person"></i>{{$post->author->name}}</span>
                <span class="badge bg-dark"><i
                        class="me-1 bi bi-calendar"></i>{{$post->created_at->format('d/m/y')}}</span>
                <span class="badge bg-dark"><i class="me-1 bi bi-clock"></i>{{$post->created_at->format('H:00
                    A')}}</span>
            </div>

            <p class="card-text mb-3">&nbsp;&nbsp;&nbsp;&nbsp; {{$post->body}}</p>

            <div class="d-flex justify-content-between">
                <a href="{{route('post.index')}}" class="btn btn-outline-dark">Back</a>
                <a href="{{route('post.create')}}" class="btn btn-dark">New Post</a>
            </div>
        </div>
    </div>
</div>
@endsection
