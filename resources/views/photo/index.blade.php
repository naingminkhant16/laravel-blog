@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
    </ol>
</nav>
<div class="card">
    <div class="card-header">
        My Gallery
    </div>
    <div class="card-body">
        <div class="card-title">Curretn User's Photo</div>
        <div class="">
            @forelse (Auth::user()->photos as $photo)
            <img src="{{asset('storage/imgs/'.$photo->name)}}" height="150" class="rounded mb-1" alt="">
            @empty
            <p class="text-black-50">No Post Photos</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
