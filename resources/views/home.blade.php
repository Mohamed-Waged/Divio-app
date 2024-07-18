@extends('layout.app')

@section('title','Home')

@section('content')
  <h1 class="p-3 border text-center my-3">
    All Posts
  </h1>
  @foreach ($posts as $post )
    <div class="card mb-3">
        <div class="card-header">
          {{ $post->user->name }} - {{ $post->created_at->format('Y-m-d') }}
        </div>
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{ Str::limit($post->description,400) }}</p>
          <a href="{{ route('posts.show',$post->id) }}" class="btn btn-primary">Show Post</a>
        </div>
    </div>
  @endforeach
  {{ $posts->links() }}
@endsection