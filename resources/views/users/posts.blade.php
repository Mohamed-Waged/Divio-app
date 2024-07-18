@extends('layout.app')

@section('title', 'All Posts')

@section('content')
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add New Post</a>
    <h1 class="text-center my-3">
        All Posts For {{$user->name}}
    </h1>
    @if (session()->get('success') != null)
        <div class="alert alert-success text-center w-50 mx-auto" role="alert">
            {{session()->get('success')}}
        </div>
    @endif
    <table class="table table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Writer</th>
                <th>Show</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($user->posts as $post)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->description,80) }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">Show</a>
                    </td>
                    <td>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('posts.destroy',$post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger text-center" role="alert">
                    No Posts Found !
                </div>
            @endforelse
        </tbody>
    </table>
@endsection
