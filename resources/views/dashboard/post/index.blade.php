@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-medium leading-tight text-gray-800">
            {{ __('Posts Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden drop-shadow-xl bg-healthymind-bg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold underline decoration-2 underline-offset-8">Your Blog Posts</h3>
                        <a href="{{ route('post.create') }}" class="px-4 py-2 bg-healthymind-dark rounded-xl text-healthymind-bg">Create New Post</a>
                    </div>
                    @if ($posts->isEmpty())
                        <p>No posts found.</p>
                    @else
                        <ul class="flex flex-col gap-6 list-disc list-outside">
                        @foreach ($posts as $post)
                            <li class="grid grid-cols-1 gap-1">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('post.show', $post->id) }}"><h3 class="text-base font-semibold">{{ $post->title }}</h3></a>
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('post.edit', $post->id) }}" class="px-3 py-1 text-sm font-medium underline underline-offset-2 hover:text-healthymind-dark">Edit</a>
                                        <form class="flex" action="{{ route('post.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-1 text-sm font-medium underline underline-offset-2 hover:text-red-500" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="w-2/3 text-sm">{{ Str::words(strip_tags($post->content), 30, '...') }}</div>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
