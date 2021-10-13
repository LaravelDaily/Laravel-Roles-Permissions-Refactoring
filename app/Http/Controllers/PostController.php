<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $posts = Post::latest()->paginate();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Post::create([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'is_published' => (bool)$request->is_published,
        ]);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('post_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->update([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'is_published' => (bool)$request->is_published,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->delete();

        return redirect()->route('posts.index');
    }
}