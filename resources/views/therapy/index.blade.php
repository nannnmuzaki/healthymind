<x-app-layout>
<section class="bg-white">
    <div class="w-full px-5 py-6 mx-auto space-y-5 sm:py-8 md:py-12 sm:space-y-8 md:space-y-16 max-w-7xl">
        <div class="flex grid grid-cols-12 pb-10 sm:px-5 gap-x-8 gap-y-16">
            @foreach ($schedules as $therapistId => $therapistSchedules)
                <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-4">
                    <a href="#_" class="flex overflow-hidden">
                        <img class="object-fill w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-56" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=2787&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                    </a>
                    <h2 class="text-lg font-bold sm:text-xl md:text-2xl"><a href="#_">{{ $therapistSchedules->first()->therapist->name }}</a></h2>
                    <ul class="flex flex-col gap-2 list-disc list-outside">
                        @foreach ($therapistSchedules as $schedule)
                            <li>
                                <div class="flex items-center justify-between">
                                    <span>{{ $schedule->start_time }} - {{ $schedule->end_time }}</span>
                                    <form action="{{ route('therapy.book', ['id' => $schedule->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 ml-4 text-sm text-white rounded-full bg-healthymind-dark">Book</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
</x-app-layout>