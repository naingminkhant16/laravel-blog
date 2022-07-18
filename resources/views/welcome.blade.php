@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <h4 class="mb-0">Hola,write a new blog?...</h4>
                            <p class="text-black-50 mb-0">What's on your mind today?</p>
                        </div>
                        <div class="">
                            <a href="/login" class="btn btn-outline-dark">New Blog</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control bg-white" value="{{request('search')}}" name="search">
                        <button class="btn btn-secondary"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="">
                {{-- @if(request('search'))
                <div class="d-flex mb-3 justify-content-start align-items-center">
                    <p class="mb-0 me-3">Search by - {{request('search')}}</p>
                    <div>
                        <a href="/"><i class="fs-6 bi bi-trash-fill text-danger"></i></a>
                    </div>
                </div>
                @endif --}}
                @isset($category)
                <div class="d-flex mb-3 justify-content-start align-items-center">
                    <p class="mb-0 me-3">Filter by - {{$category->title}}</p>
                    <div>
                        <a href="/"><i class="fs-6 bi bi-trash-fill text-danger"></i></a>
                    </div>
                </div>
                @endisset
                @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h4 class="card-title mb-0">
                                    {{$post->title}}
                                </h4>
                            </div>
                            {{-- <div class="">
                                <div class="dropdown">
                                    <i class="bi bi-three-dots" type='button' id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown"></i>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item text-dark" href="">Edit</a>
                                        </li>
                                        <li>
                                            <form class="dropdown-item d-inline-block m-0 p-2" action="" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="text-danger m-0 bg-transparent border-0"
                                                    type="submit">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                        <hr class="">
                        <a href="{{route('cat',$post->category->slug)}}">
                            <span class="badge bg-secondary mb-3">{{$post->category->title}}</span>
                        </a>
                        @isset($post->image)
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{asset('storage/imgs/'.$post->image)}}" class="rounded" height="300">
                        </div>
                        @endisset

                        <div class="card-text text-black-50 mb-3">{{Str::words($post->body,50)}}</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <p class="mb-0 text-black-50">Author - {{$post->author->name}}</p>
                                <small class="text-black-50">
                                    {{$post->created_at->diffForHumans()}}
                                </small>
                            </div>
                            <a href="/detail/{{$post->slug}}" class="btn me-1 btn-sm btn-outline-dark">Details
                                <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="">
                {{$posts->onEachSide(1)->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
