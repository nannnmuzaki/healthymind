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

                            <div class="container p-6 mx-auto">
                                <h1 class="mb-6 text-2xl font-bold">Media Library</h1>

                                <!-- Upload Form -->
                                <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data" class="mb-6">
                                    @csrf
                                    <label class="block mb-2 text-sm font-medium text-gray-700" for="media">Upload Image</label>
                                    <input type="file" name="media" id="media" accept="image/*"
                                        class="block w-full px-4 py-2 mb-6 border rounded-md shadow-sm focus:ring focus:ring-healthymind-light focus:outline-none">
                                    <button type="submit"
                                            class="px-4 py-2 text-white rounded-full bg-healthymind-dark hover:bg-healthymind-light">
                                        Upload
                                    </button>
                                </form>

                                <!-- Display Uploaded Media -->
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach ($media as $image)
                                        <div class="relative border rounded shadow">
                                            <img src="{{ $image->url }}" alt="{{ $image->filename }}" class="w-full rounded">
                                            <p class="mt-2 text-sm font-medium text-center">{{ $image->filename }}</p>
                                            <form action="{{ route('media.destroy', $image->id) }}" method="POST" class="absolute top-2 right-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    &times;
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
