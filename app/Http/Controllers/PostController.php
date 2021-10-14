<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize('post_view');

        $posts = Post::latest()->paginate();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('post_create');

        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $this->authorize('post_create');

        Post::create([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'is_published' => (bool)$request->is_published,
        ]);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        $this->authorize('post_view');

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('post_edit');

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('post_edit');

        $post->update([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'is_published' => (bool)$request->is_published,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('post_delete');

        $post->delete();

        return redirect()->route('posts.index');
    }
}