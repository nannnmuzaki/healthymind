<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class MediaController extends Controller
{
    /**
     * Display the media library.
     */
    public function index()
    {
        $media = Media::latest()->get();

        return view('media.index', compact('media'));
    }

    /**
     * Handle the media upload.
     */
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'media' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Limit to 2MB
        ]);

        // Store the uploaded file in the public disk under 'media' folder
        $path = $request->file('media')->store('media', 'public');

        // Save media details in the database
        $media = Media::create([
            'filename' => $request->file('media')->getClientOriginalName(),
            'path' => $path,
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('media.index')->with('success', 'Image uploaded successfully.');
    }

    /**
     * Delete media.
     */
    public function destroy(Media $media)
    {
        // Delete the file from storage
        Storage::disk('public')->delete($media->path);

        // Delete the database record
        $media->delete();

        return response()->json([
            'message' => 'Media deleted successfully.',
        ]);
    }
}
