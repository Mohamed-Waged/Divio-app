@extends('layout.app')

@section('title','Edit Tag')

@section('content')
    <h1 class="text-center my-2">
        Edit Tag
    </h1>
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="{{route('tags.update',$tag->id)}}" method="post" class="border p-3">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{old('name') ?? $tag->name}}" class="form-control">
                    @error('name')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning px-3">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection