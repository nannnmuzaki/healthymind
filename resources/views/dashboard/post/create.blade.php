<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('post.store') }}" method="POST" id="post-form">
                        @csrf
                        <div class="mb-4">
                            <label class="text-lg font-semibold" for="title">Title</label><br>
                            <input class="w-full rounded-sm form-input" type="text" name="title" id="title" required>
                        </div>
                        <div>
                            <label class="text-lg font-semibold" for="content">Content</label>
                            <div id="content-editor"></div>
                            <input type="hidden" name="content" id="content">
                        </div>
                        <button class="px-4 py-2 mt-4 bg-green-700 rounded-xl text-slate-50" type="submit">Create Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>