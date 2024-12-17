<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mews\Purifier\Facades\Purifier;
use App\Models\BlogPost;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;


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

        // Get all media (images) from the media table
        $media = Media::all();
        
        // Return the create view with the media list
        return view('dashboard.post.create', compact('media'));
    }

    public function store(Request $request)
    {
        $this->authorize('store', BlogPost::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string',
        ]);

        auth()->user()->blogPosts()->create([
            'title' => $request->input('title'),
            'content' => Purifier::clean($request->input('content')),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }

    public function show($slug)
    {
        $this->authorize('view', BlogPost::class);
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('post'));
    }

    public function edit(BlogPost $post)
    {
        $this->authorize('update', $post);

        // Get all media (images) from the media table
        $media = Media::all();

        return view('dashboard.post.edit', compact('post', 'media'));
    }

    public function update(Request $request, $id)
    {   
    $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|unique:blog_posts,slug,' . $id, // Ignore current post's slug
        'content' => 'required|string',
        'featured_image' => 'nullable|exists:media,id', // Validate existing image selection
        'new_featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate new image upload
    ]);

    $blogPost = BlogPost::findOrFail($id);

    // Determine if a new image is uploaded or an existing image is selected
    $imageId = $blogPost->image; // Start with the current image ID, in case the image isn't changed

    if ($request->hasFile('new_featured_image')) {
        // If a new image is uploaded, delete the old image from the storage
        if ($blogPost->image) {
            $oldImage = Media::find($blogPost->image);
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage->path); // Delete old image file
                $oldImage->delete(); // Delete old image record from database
            }
        }

        // Upload the new image to the media table
        $path = $request->file('new_featured_image')->store('media', 'public'); // Store in 'public/media'

        // Save the media information to the Media table
        $media = Media::create([
            'filename' => basename($path),
            'path' => $path,
            'uploaded_by' => auth()->id(),
        ]);

        // Use the uploaded media's ID
        $imageId = $media->id;
        } elseif ($request->has('featured_image')) {
            // If an image is selected from the existing ones, update the image ID
            $imageId = $request->featured_image;
        }

        // Update the blog post with the new image ID
        $blogPost->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $imageId, // Save the new or selected image ID
        ]);

        // Redirect to a success page
        return redirect()->route('post.index')->with('success', 'Blog post updated successfully!');
    }   

    public function destroy(BlogPost $post)
    {
        \Log::info('Deleting post', ['post_id' => $post->id]);
        $this->authorize('delete', $post);

        // Delete the post's image if it exists
        if ($post->image) {
            $image = Media::find($post->image);
            if ($image) {
                Storage::disk('public')->delete($image->path); // Delete the image file
                $image->delete(); // Delete the image record from the database
            }
        }

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully!');
    }
}