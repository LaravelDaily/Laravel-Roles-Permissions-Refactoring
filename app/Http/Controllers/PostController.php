<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin')->only('destroy');
    }

    public function index()
    {
        $posts = Post::latest()->paginate();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        throw_if(auth()->user()->hasRole('user') && $request->is_published == true,
            ValidationException::withMessages(['is_published' => 'User cannot publish post'])
        );

        Post::create([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'is_published' => (bool)$request->is_published,
        ]);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        throw_if(auth()->user()->hasRole('user') && $request->is_published == true,
            ValidationException::withMessages(['is_published' => 'User cannot publish post'])
        );

        $post->update([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'is_published' => (bool)$request->is_published,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}