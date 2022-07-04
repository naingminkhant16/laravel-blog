@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Categories</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">Manage Categories</h4>
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
                        <th>Slug</th>
                        <th>Actions</th>
                        <th>Created At</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td class="">
                            {{$category->title}}
                        </td>
                        @notAuthor
                        <td>{{$category->author->name}}</td>
                        @endnotAuthor
                        <td class=""> <span class="badge bg-secondary">{{$category->slug}}</span></td>
                        <td>
                            <div class="d-flex justify-content-start">
                                {{-- <a href="{{route('category.show',$category->id)}}"
                                    class="btn me-1 btn-outline-dark btn-sm"><i class="bi bi-info-circle"></i></a> --}}
                                <a href="{{route('category.edit',$category->id)}}"
                                    class="btn me-1 btn-outline-dark btn-sm"><i class="bi bi-pencil"></i></a>
                                <form action="{{route('category.destroy',$category->id)}}" id="del{{$category->id}}"
                                    class="d-none" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button onclick="confirmDelete({{$category->id}})" class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-trash3"></i></button>
                            </div>
                        </td>
                        <td class="text-black-50">
                            <i class="bi bi-calendar"></i> {{$category->created_at->format('d/m/y')}}
                            <br>
                            <i class="bi bi-clock"></i>{{$category->created_at->format('H:00 A')}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
