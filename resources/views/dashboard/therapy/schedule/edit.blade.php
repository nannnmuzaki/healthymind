<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm bg-healthymind-bg sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex min-w-full min-h-screen">
                        <div class="flex flex-col items-center justify-start border-r-2 border-healthymind-dark min-w-max">
                            <h1 class="w-full px-6 py-5 text-xl font-semibold border-b-2 border-healthymind-dark">Dashboard</h1>
                            <a href="{{ route('session.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Therapy Session</a>
                            <a href="{{ route('schedule.manage') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Schedule</a>
                            <a href="{{ route('post.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Posts</a>
                            <a href="{{ route('media.index') }}" class="w-full px-6 py-4 text-sm font-medium border-b-2 border-healthymind-dark">Media</a>
                        </div>
                        <div class="flex flex-col flex-grow min-h-screen gap-4 p-6">
                            <div class="flex justify-between">
                                <h1 class="text-lg font-semibold underline underline-offset-8 decoration-healthymind-dark">Create Therapy Schedules</h1>
                            </div>
                            <form class="flex flex-col items-start justify-start flex-grow gap-2" action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-col gap-1">
                                    <label for="start_time">Start Time (HH:MM format, 24-hour clock)</label>
                                    <input type="text" name="start_time" class="rounded-md form-input bg-healthymind-bg" value="{{ $schedule->start_time }}" placeholder="08:00">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="end_time">End Time (HH:MM format, 24-hour clock)</label>
                                    <input type="text" name="end_time" class="rounded-md form-input bg-healthymind-bg" value="{{ $schedule->end_time }}" placeholder="10:00">
                                </div>
                                <button type="submit" class="px-4 py-2 mt-2 text-sm rounded-full text-healthymind-bg bg-healthymind-dark">Save Schedule</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

