@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm bg-healthymind-bg sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex min-w-full min-h-screen">
                        <div class="flex flex-col items-center justify-start border-r-2 border-healthymind-dark min-w-max">
                            <h1 class="w-full px-6 py-5 text-xl font-semibold border-b-2 border-healthymind-dark">Dashboard</h1>
                            <a href="#" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Therapy Session</a>
                            <a href="{{ route('schedule.manage') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Schedule</a>
                            <a href="{{ route('post.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Posts</a>
                            <a href="{{ route('media.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Media</a>
                        </div>
                        <div class="flex flex-col flex-grow min-h-screen gap-4 p-6">
                            <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold underline decoration-2 underline-offset-8">Your Blog Posts</h3>
                        <a href="{{ route('post.create') }}" class="px-4 py-2 bg-healthymind-dark rounded-xl text-healthymind-bg">Create New Post</a>
                    </div>
                        @if ($posts->isEmpty())
                            <p>No posts found.</p>
                        @else
                            <ul class="flex flex-col gap-6 list-disc">
                            @foreach ($posts as $post)
                                <li class="grid grid-cols-1 gap-1">
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('post.show', $post->slug) }}"><h3 class="text-base font-semibold">{{ $post->title }}</h3></a>
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('post.edit', $post->id) }}" class="px-3 py-1 text-sm font-medium underline underline-offset-2 hover:text-healthymind-dark">Edit</a>
                                            <form class="flex" action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-3 py-1 text-sm font-medium underline underline-offset-2 hover:text-red-500" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
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
    </div>
</x-app-layout>
