<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mews\Purifier\Facades\Purifier;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    use AuthorizesRequests;

    public function viewAll()
    {
        $this->authorize('viewAny', BlogPost::class);
        $posts = BlogPost::all();
        return view('blog.index', compact('posts'));
    }

    public function index()
    {
        $this->authorize('view', BlogPost::class);
        $posts = auth()->user()->blogPosts()->get();
        return view('dashboard.post.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', BlogPost::class);
        return view('dashboard.post.create');
    }

    public function store(Request $request)
    {
        $this->authorize('store', BlogPost::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        auth()->user()->blogPosts()->create([
            'title' => $request->input('title'),
            'content' => Purifier::clean($request->input('content')),
        ]);

        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }

    public function show($id)
    {
        $this->authorize('view', BlogPost::class);

        $post = BlogPost::findOrFail($id);

        return view('blog.show', compact('post'));
    }

    public function edit(BlogPost $post)
    {
        $this->authorize('update', $post);

        return view('dashboard.post.edit', compact('post'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $sanitizedContent = Purifier::clean($request->input('content'));

        $post->update([
            'title' => $request->input('title'),
            'content' => $sanitizedContent,
        ]);

        return redirect()->route('post.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(BlogPost $post)
    {
        \Log::info('Deleting post', ['post_id' => $post->id]);
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully!');
    }
}