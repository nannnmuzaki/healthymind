<x-app-layout>

<section class="bg-white">
    <div class="w-full min-h-screen px-5 py-6 mx-auto space-y-5 sm:py-8 md:py-12 sm:space-y-8 md:space-y-16 max-w-7xl">
        <div class="flex grid grid-cols-12 pb-10 sm:px-5 gap-x-8 gap-y-16">
            @foreach ($posts as $post)
                <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-4">
                    <a href="#_" class="block">
                        <img class="object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-56" src="https://images.unsplash.com/photo-1564383424695-05a0668266ec?q=80&w=2741&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                    </a>
                    <h2 class="text-lg font-bold sm:text-xl md:text-2xl"><a href="{{ route('post.show', $post->id) }}">{{ Str::words(($post->title), 8, '...')  }}</a></h2>
                    <p class="text-sm text-gray-500">{{ Str::words(strip_tags($post->content), 20, '...') }}</p>
                    <p class="pt-2 text-xs font-medium"><a href="#_" class="mr-1 underline">{{ $post->user->name }}</a> · <span class="mx-1">{{ $post->created_at->format('F j, Y') }}</span> · <span class="mx-1 text-gray-600">3 min. read</span></p>
                </div>
            @endforeach
        </div>
    </div>
</section>

</x-app-layout>