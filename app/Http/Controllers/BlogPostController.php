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

        $posts = BlogPost::get();
        return view('blog.index', compact('posts'));
    }

    public function index()
    {
        $this->authorize('viewAny', BlogPost::class);

        $posts = auth()->user()->blogPosts()->get();
        return view('dashboard.post.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', BlogPost::class);

        return view('dashboard.post.create'); // Return the post creation form
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('store', BlogPost::class);

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new blog post associated with the authenticated user
        auth()->user()->blogPosts()->create([
            'title' => $request->input('title'),
            'content' => Purifier::clean($request->content),
        ]);

        // Redirect to the posts index with a success message
        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {   
        $this->authorize('view', BlogPost::class);

        // Find the post by ID or return a 404 if not found
        $post = BlogPost::findOrFail($id);

        // Pass the post to the view
        return view('blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update', BlogPost::class);

        $post = auth()->user()->blogPosts()->findOrFail($id);
        return view('dashboard.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
    $this->authorize('update', $blogPost);

    $sanitizedContent = Purifier::clean($request->input('content'));

    $blogPost->update([
        'title' => $request->input('title'),
        'content' => $sanitizedContent,
    ]);

    return redirect()->route('post.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        $this->authorize('delete', $blogPost);

        $blogPost->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully!');
    }

}
