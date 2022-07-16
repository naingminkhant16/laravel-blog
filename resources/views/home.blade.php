@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        Home
    </div>
    <div class="card-body">
        This is home
        <br>
        Current User's Nation is {{Auth::user()->nation->name}} <br>

        {{-- {{App\Models\Nation::first()->posts->first()}} --}}
    </div>
</div>
@endsection
