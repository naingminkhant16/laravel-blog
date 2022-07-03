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
        {{Auth::user()->isAdmin()}}
    </div>
</div>
@endsection