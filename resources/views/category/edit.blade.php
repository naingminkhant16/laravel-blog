@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Category</h4>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <form action="{{route('category.update',$category->id)}}" method="post">
                    @csrf
                    @method('put')
                    <label for="title" class="form-label">Category Title</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{old('title',$category->title)}}">
                        <button class="btn btn-primary" type="submit">Update</button>
                        @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
