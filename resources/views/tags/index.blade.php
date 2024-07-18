@extends('layout.app')

@section('title', 'All Tags')

@section('content')
    <a href="{{ route('tags.create') }}" class="btn btn-success">Add New Tag</a>
    <h1 class="text-center my-3">
        All Tags
    </h1>
    @if (session()->get('success') != null)
        <div class="alert alert-success text-center w-50 mx-auto" role="alert">
            {{session()->get('success')}}
        </div>
    @endif
    <table class="table table-striped mt-3 ">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Posts</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tags as $tag)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $tag->name }}</td>
                    <td>
                        @foreach ($tag->posts as $post )
                            <span class="badge bg-success my-1">{{ $post->title }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('tags.destroy',$tag->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger text-center" role="alert">
                    No Tags Found !
                </div>
            @endforelse
        </tbody>
    </table>
    {{ $tags->links() }}
@endsection
