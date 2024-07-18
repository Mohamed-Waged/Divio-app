@extends('layout.app')

@section('title','Create User')

@section('content')
    <h1 class="text-center mb-1">
        Create New User
    </h1>
    <div class="row">
        <div class="col-6 mx-auto">
            @if (session()->get('success') != null)
                <div class="alert alert-success text-center" role="alert">
                    {{session()->get('success')}}
                </div>
            @endif
            <form action="{{ route('users.store') }}" method="post" class="border p-3">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control">
                    @error('name')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
                    @error('email')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    @error('confirm_password')
                        <div class="text-danger px-2">* {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="writer">Writer</option>
                    </select>
                    @error('type')
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