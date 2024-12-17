<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm bg-healthymind-bg sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex min-h-screen">
                        <div class="flex flex-col items-center justify-start border-r-2 border-healthymind-dark min-w-max">
                            <h1 class="w-full px-6 py-5 text-xl font-semibold border-b-2 border-healthymind-dark">Dashboard</h1>
                            <a href="{{ route('session.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Therapy Session</a>
                            @if(auth()->user()->role === 2 || auth()->user()->role === 3)
                                <a href="{{ route('schedule.manage') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Schedule</a>
                                <a href="{{ route('post.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Posts</a>
                                <a href="{{ route('media.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Media</a>
                            @endif
                        </div>
                        <div class="p-6">
                            <span class="px-4 py-6 text-2xl font-semibold">Hi, {{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
