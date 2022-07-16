<div class="list-group mb-3">
    <a href="{{route('home')}}" class="list-group-item list-group-item-action">Home</a>
    <a href="{{route('photo.index')}}" class="list-group-item list-group-item-action">Your Gallery</a>
</div>

<small class="text-black-50">Manage Posts</small>
<div class="list-group mb-3">
    <a href="{{route('post.index')}}" class="list-group-item list-group-item-action">Posts</a>
    <a href="{{route('post.create')}}" class="list-group-item list-group-item-action">Create New Post</a>
</div>

<small class="text-black-50">Manage Categories</small>
<div class="list-group mb-3">
    <a href="{{route('category.index')}}" class="list-group-item list-group-item-action">Categories</a>
    <a href="{{route('category.create')}}" class="list-group-item list-group-item-action">Create New Category</a>
</div>

@admin
<small class="text-black-50">Manage Users</small>
<div class="list-group mb-3">
    <a href="{{route('user.index')}}" class="list-group-item list-group-item-action">Users</a>
    {{-- <a href="{{route('user.create')}}" class="list-group-item list-group-item-action">Create New User</a> --}}
</div>
@endadmin
