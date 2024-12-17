<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm bg-healthymind-bg sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex min-w-full min-h-screen">
                        <div class="flex flex-col items-center justify-start border-r-2 border-healthymind-dark min-w-max">
                            <h1 class="w-full px-6 py-5 text-xl font-semibold border-b-2 border-healthymind-dark">Dashboard</h1>
                            <a href="{{ route('session.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Therapy Session</a>
                            @if(auth()->user()->role === 2 || auth()->user()->role === 3)
                                <a href="{{ route('schedule.manage') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Schedule</a>
                                <a href="{{ route('post.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Posts</a>
                                <a href="{{ route('media.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Media</a>
                            @endif
                        </div>
                        <div class="flex flex-col flex-grow min-h-screen p-6">
                            <div class="flex justify-between">
                                <h1 class="text-lg font-semibold underline underline-offset-8 decoration-healthymind-dark">Manage Therapy Schedules</h1>
                                <a href="{{ route('schedule.create') }}" class="px-3 py-2 text-sm rounded-full text-healthymind-bg bg-healthymind-dark">Create New Schedule</a>
                            </div>
                            <table class="min-w-full mt-4">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Start Time</th>
                                        <th class="px-4 py-2">End Time</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $schedule)
                                        <tr>
                                            <td class="px-4 py-2 border">{{ $schedule->start_time }}</td>
                                            <td class="px-4 py-2 border">{{ $schedule->end_time }}</td>
                                            <td class="px-4 py-2 border">{{ $schedule->status }}</td>
                                            <td class="flex items-center justify-center flex-grow gap-2 px-4 py-2 border">
                                                <a href="{{ route('schedule.edit', $schedule->id) }}" class="px-4 py-2 text-sm rounded-full bg-healthymind-dark text-healthymind-bg">Edit</a>
                                                <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 text-sm bg-red-500 rounded-full text-healthymind-bg">Delete</button>
                                                </form>
                                                <form action="{{ route('schedule.toggleStatus', $schedule->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-4 py-2 text-sm rounded-full bg-healthymind-dark text-healthymind-bg">
                                                        {{ $schedule->status === 'available' ? 'Mark Unavailable' : 'Mark Available' }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

