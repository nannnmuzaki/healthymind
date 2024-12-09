<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="py-24 bg-white sm:py-32">
                        <div class="px-6 mx-auto max-w-7xl lg:px-8">
                            <div class="max-w-2xl mx-auto lg:mx-0">
                            <h2 class="text-4xl font-semibold tracking-tight text-gray-900 text-pretty sm:text-5xl">From the blog</h2>
                            <p class="mt-2 text-gray-600 text-lg/8">Our wonderful therapist writings.</p>
                            </div>
                            <div class="grid max-w-2xl grid-cols-1 pt-10 mx-auto mt-10 border-t border-gray-200 gap-x-8 gap-y-16 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                            @foreach ( $posts as $post)
                                <article class="flex flex-col items-start justify-between max-w-xl">
                                <div class="flex items-center text-xs gap-x-4">
                                <time datetime="2020-03-16" class="text-gray-500">{{ $post->created_at->format('F j, Y') }}</time>
                                </div>
                                <div class="relative group">
                                <h3 class="mt-3 font-semibold text-gray-900 text-lg/6 group-hover:text-gray-600">
                                    <a href="{{ route('post.show', $post->id) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="mt-5 text-gray-600 line-clamp-3 text-sm/6">{{ strip_tags($post->content) }}</p>
                                </div>
                                <div class="relative flex items-center mt-8 gap-x-4">
                                <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="rounded-full size-10 bg-gray-50">
                                <div class="text-sm/6">
                                    <p class="font-semibold text-gray-900">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        {{ $post->user->name }}
                                    </a>
                                    </p>
                                    <p class="text-gray-600">HealthyMind Therapist</p>
                                </div>
                                </div>
                            </article>
                            @endforeach

                            <!-- More posts... -->
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
