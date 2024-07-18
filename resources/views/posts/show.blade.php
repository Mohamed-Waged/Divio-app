@extends('layout.app')

@section('title','Show Post')

@section('content')
    <div class="row">
        <div class="col-9 mx-auto">
            <div class="card mb-3">
                <div class="card-header">
                    {{ $post->user->name }} - {{ $post->created_at->format('Y-m-d') }}
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if($post->image != null)
                            <img src="{{asset($post->image)}}" alt="{{ $post->title }}" style="height:250px">
                        @else
                            <img src="https://placehold.jp/100x100.png" alt="{{ $post->title }}" style="height:250px">
                        @endif
                    </div>
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{ $post->description }}</p>
                    <a href="{{ URL::previous() }}" class="btn btn-primary px-3">Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection