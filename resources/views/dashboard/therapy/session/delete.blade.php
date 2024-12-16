<x-app-layout>
    <h1>Delete Therapy Schedule</h1>
    <p>Are you sure you want to delete this schedule?</p>
    <form action="{{ route('therapist.destroySchedule', $schedule->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-3 py-1 bg-red-600 rounded-full">Delete Schedule</button>
    </form>
</x-app-layout>