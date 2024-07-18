@extends('layout.app')

@section('title','Create Post')

@section('content')
    <h1 class="text-center my-2">
        Create Post
    </h1>
    <div class="row">
        <div class="col-6 mx-auto">
            @if (session()->get('success') != null)
                <div class="alert alert-success text-center" role="alert">
                    {{session()->get('success')}}
                </div>
            @endif
            <form action="{{ route('posts.store') }}" method="post" class="border p-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control">
                    @error('title')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" style="resize: none">{{old('description')}}</textarea>
                    @error('description')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="user">User</label>
                    <select name="user_id" id="user" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="tags">Tags</label>
                    <select multiple name="tags[]" id="tags" class="form-control" >
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                    @error('tags')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image"  class="form-control">
                    @error('image')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-success ">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection