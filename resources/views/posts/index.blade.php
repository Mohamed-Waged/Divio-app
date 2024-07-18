@extends('layout.app')

@section('title', 'All Posts')

@section('content')
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add New Post</a>
    <h1 class="text-center my-3">
        All Posts
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
                <th>Tags</th>
                <th>Image</th>
                <th>Show</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->description,80) }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        @foreach ($post->tags as $tag )
                            <span class="badge bg-warning my-1">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if($post->image != null)
                            <img src="{{asset($post->image)}}" alt="{{ $post->title }}" style="width:100px">
                        @else
                            <img src="https://placehold.jp/100x100.png" alt="{{ $post->title }}" style="width:100px">
                        @endif
                    </td>
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
    {{ $posts->links() }}
@endsection
