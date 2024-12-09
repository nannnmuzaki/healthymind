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
                <div>{!! $post->content !!}</div>
            </div>
        </div>
    </div>
</x-app-layout>