<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto my-8 overflow-hidden bg-white shadow-sm min-w-fit sm:rounded-lg">
            <div class="py-4 mx-auto my-8 prose">
                <h1 class="mb-8 text-3xl font-semibold">{{ $post->title }}</h1>
                @if ($post->featuredImage)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $post->featuredImage->path) }}" alt="{{ $post->title }}" class="h-auto max-w-full mt-2 rounded-lg">
                    </div>
                @else
                    <p class="mt-4 text-gray-500">No featured image available.</p>
                @endif
                <div>{!! $post->content !!}</div>
            </div>
        </div>
    </div>
</x-app-layout>