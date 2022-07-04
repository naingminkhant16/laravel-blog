@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New Category</h4>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <form action="{{route('category.store')}}" method="post">
                    @csrf
                    <label for="title" class="form-label">Category Title</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{old('title')}}">
                        <button class="btn btn-primary" type="submit">Upload</button>
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
