<?php

namespace App\Http\Controllers;

use File;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $users = User::all();
        $tags = Tag::select('id','name')->get();
        return view('posts.create', compact('users','tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|max:500',
            'user_id' => 'required|exists:users,id',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $image = $request->file('image')->store('public/images');

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->image = $image;

        $post->save();

        $post->tags()->attach($request->tags);

        return back()->with('success', 'Post Added Succeffuly');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        $tags = Tag::select('id','name')->get();
        return view('posts.edit', compact('post', 'users','tags'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|max:500',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        $post = Post::findOrFail($id);
        $old_image = $request->image;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        
        if ($request->hasFile('image')) {
            $new_image = $request->file('image')->store('public/images');
            File::delete($old_image);
            $post->image = $new_image;
        }

        $post->save();

        $post->tags()->detach();
        $post->tags()->attach($request->tags);
        return redirect()->route('posts.index')->with('success', 'Post Updated Succeffuly');
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return back()->with('success', 'Post Deleted Succeffuly');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $posts = Post::where('title', 'like', '%' . $search . '%')->paginate(10);
        return view('home', compact('posts'));
    }
}
