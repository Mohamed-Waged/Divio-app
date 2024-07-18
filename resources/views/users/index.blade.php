@extends('layout.app')

@section('title', 'All Users')

@section('content')
    <a href="{{ route('users.create') }}" class="btn btn-success">Add New User</a>
    <h1 class="text-center my-3">
        All Users
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
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Posts</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{!! $user->type() !!}</td>
                    <td>
                        <a href="{{route('user.posts',$user->id)}}" class="btn btn-primary">Show</a>
                    </td>
                    <td>
                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('users.destroy',$user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger text-center" role="alert">
                    No Users Found !
                </div>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
