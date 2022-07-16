@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('post.index')}}">Posts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Post</h4>
        <hr>
        <div class="container">
            <form action="{{route('post.update',$post->id)}}" id="updatePost" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
            </form>
            <div class="d-flex justify-content-between">
                <div class="">
                    @forelse ($post->photos as $photo)
                    <div class="position-relative d-inline-block">
                        <img src="{{asset('storage/imgs/'.$photo->name)}}" height="100" class="rounded mb-1" alt="">

                        <form action="{{route('photo.destroy',$photo->id)}}" id="del{{$photo->id}}" class="d-none"
                            method="POST">
                            @csrf
                            @method('delete')
                        </form>
                        <button type="submit" onclick="confirmDelete({{$photo->id}})"
                            class="btn btn-lg p-1 d-inline-block position-absolute top-0 start-0">
                            <i class="bi bi-x-circle text-danger"></i></button>
                    </div>
                    @empty
                    <p class="text-black-50">No Post Photos</p>
                    @endforelse
                </div>
                @isset($post->image)
                <div class="d-flex justify-content-end mb-3">
                    <div class="w-50 h-50">
                        <img src="{{asset('storage/imgs/'.$post->image)}}" class="img-fluid rounded">
                    </div>
                </div>
                @endisset
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" id="title" form="updatePost" name="title" class="form-control @error('title')
                        is-invalid
                    @enderror " value="{{old('title',$post->title)}}">
                @error('title')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Post Category</label>
                <select name="category" form="updatePost" class="form-select
                    @error('category')
                    is-invalid
                    @enderror" id="category">

                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if($category->id==old('category',$post->category_id))
                        selected
                        @endif>
                        {{$category->title}}
                    </option>
                    @endforeach

                </select>
                @error('category')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="photos" class="form-label">Post Photos</label>
                <input form="updatePost" name="photos[]" type="file" multiple id="photos" class="form-control @error('photos')
                    is-invalid @enderror @error('photos.*') is-invalid @enderror">

                @error('photos')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror

                @error('photos.*')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Post Body</label>
                <textarea form="updatePost" name="body" id="body" class="form-control @error('body')
                    is-invalid
                @enderror" cols="30" rows="10">{{old('body',$post->body)}}</textarea>
                @error('body')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <label for="image" class="form-label">Featured Image</label>
                    <input form="updatePost" type="file" class="form-control @error('image') is-invalid @enderror"
                        id="image" name="image">
                    @error('image')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" form="updatePost" class="btn btn-primary btn-lg">Update Post</button>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
