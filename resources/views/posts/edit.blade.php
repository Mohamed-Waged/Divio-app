@extends('layout.app')

@section('title','Edit Post')

@section('content')
    <h1 class="text-center my-2">
        Edit Post
    </h1>
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="{{route('posts.update',$post->id)}}" method="post" class="border p-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{old('title') ?? $post->title}}">
                    @error('title')
                        <div class="text-danger">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" style="resize: none">{{old('description') ?? $post->description}}</textarea>
                    @error('description')
                        <div class="text-danger">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="user">Writer</label>
                    <select name="user_id" id="user" class="form-control">
                        @foreach ($users as $user)
                            <option @selected($user->id == $post->user_id) value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    @error('user')
                        <div class="text-danger">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="tags">Tags</label>
                    <select multiple name="tags[]" id="tags" class="form-control" >
                        @foreach ($tags as $tag)
                            <option @if($post->tags->contains($tag)) selected @endif value="{{$tag->id}}">{{$tag->name}}</option>
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
                <div class='text-center'>
                    <img src="{{asset($post->image)}}" alt="{{ $post->title }}" style="width:100px">
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection