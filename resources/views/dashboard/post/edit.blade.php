<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="text-lg font-semibold" for="title">Title</label><br>
                            <input class="w-full rounded-sm form-input" type="text" name="title" id="title" value="{{ $post->title }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="text-lg font-semibold" for="slug">Slug</label><br>
                            <input class="w-full rounded-sm form-input" type="text" name="slug" id="slug" placeholder="example: blog-post-title" value="{{ $post->slug }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="featured_image" class="block text-sm font-medium">Choose Featured Image</label>
                            <select name="featured_image" id="featured_image" class="block w-full px-3 py-2 mt-1 border rounded">
                                <option value="">-- Choose an Image --</option>
                                @foreach ($media as $item)
                                    <option value="{{ $item->id }}" {{ $post->image == $item->id ? 'selected' : '' }}>{{ $item->filename }}</option>
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-sm text-gray-500">Or upload a new image</span>
                                <input type="file" name="new_featured_image" accept="image/*" class="block w-full px-3 py-2 mt-1 border rounded">
                            </div>
                        </div>
                        <div>
                            <label for="content" class="text-lg font-semibold">Content</label>
                            <div id="content-editor"></div>
                            <input type="hidden" name="content" id="content" value="{{ $post->content }}">
                        </div>
                        <button class="px-4 py-2 mt-4 bg-healthymind-dark rounded-xl text-slate-50" type="submit">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>