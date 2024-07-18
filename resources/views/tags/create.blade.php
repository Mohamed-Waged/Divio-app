@extends('layout.app')

@section('title','Create Tag')

@section('content')
    <h1 class="text-center mb-2">
        Create New Tag
    </h1>
    <div class="row">
        <div class="col-6 mx-auto">
            @if (session()->get('success') != null)
                <div class="alert alert-success text-center" role="alert">
                    {{session()->get('success')}}
                </div>
            @endif
            <form action="{{ route('tags.store') }}" method="post" class="border p-3">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control">
                    @error('name')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success ">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection