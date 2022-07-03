@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('post.index')}}">Posts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New Post</h4>
        <hr>
        <div class="container">
            <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" id="title" name="title" class="form-control @error('title')
                        is-invalid
                    @enderror " value="{{old('title')}}">
                    @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Post Category</label>
                    <select name="category" class="form-select  
                    @error('category')
                    is-invalid
                    @enderror" id="category">

                        @foreach (App\Models\Category::all() as $category)
                        <option value="{{$category->id}}" @if($category->id==old('category'))
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
                    <label for="body" class="form-label">Post Body</label>
                    <textarea name="body" id="body" class="form-control @error('body')
                    is-invalid
                @enderror" cols="30" rows="10">{{old('body')}}</textarea>
                    @error('body')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <label for="image" class="form-label">Featured Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image">
                        @error('image')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary btn-lg">Upload Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection