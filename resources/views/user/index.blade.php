@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">Manage Users</h4>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Total</th>
                        <th>Actions</th>
                        <th>Created At</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td class="">
                            {{$user->name}}
                        </td>
                        <td class="text-black-50">{{$user->email}}</td>
                        <td>
                            <span class="badge bg-danger">{{$user->role}}</span>
                        </td>
                        <td class="">
                            <span class="badge bg-secondary">Posts - {{$user->posts->count()}}</span>
                            <br>
                            <span class="badge bg-secondary">Category - {{$user->categories->count()}}</span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start">
                                {{-- <a href="{{route('post.show',$user->id)}}"
                                    class="btn me-1 btn-outline-dark btn-sm"><i class="bi bi-info-circle"></i></a> --}}
                                {{-- <a href="{{route('post.edit',$user->id)}}"
                                    class="btn me-1 btn-outline-dark btn-sm"><i class="bi bi-pencil"></i></a> --}}
                                <form action="{{route('user.destroy',$user->id)}}" id="del{{$user->id}}" class="d-none"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button onclick="confirmDelete({{$user->id}})" class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-trash3"></i></button>
                            </div>
                        </td>
                        <td class="text-black-50">
                            <i class="bi bi-calendar"></i> {{$user->created_at->format('d/m/y')}}
                            <br>
                            <i class="bi bi-clock">{{$user->created_at->format('H:00 A')}}</i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
