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
                            @endif
                        </div>
                        <div class="flex flex-col flex-grow min-h-screen p-6">
                            <div class="flex justify-between">
                                <h1 class="mb-6 text-lg font-semibold underline underline-offset-8 decoration-healthymind-dark">Manage Therapy Sessions</h1>
                            </div>
                            <table class="min-w-full bg-white rounded-lg shadow">
                                <thead>
                                    <tr>
                                        @if (auth()->user()->role === 2 || auth()->user()->role === 3)
                                            <th class="px-4 py-2 text-left">Client Name</th>
                                        @else
                                            <th class="px-4 py-2 text-left">Therapist Name</th>
                                        @endif
                                        <th class="px-4 py-2 text-left">Schedule</th>
                                        <th class="px-4 py-2 text-left">Paid</th>
                                        <th class="px-4 py-2 text-left">Session Link</th>
                                        <th class="px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sessions as $session)
                                        <tr class="border-t">
                                            @if (auth()->user()->role === 2 || auth()->user()->role === 3)
                                                <td class="px-4 py-2">{{ $session->user->name }}</td>
                                            @else
                                                <td class="px-4 py-2">{{ $session->therapist->name }}</td>
                                            @endif
                                            <td class="px-4 py-2">{{ $session->therapySchedule->start_time }} - {{ $session->therapySchedule->end_time }}</td>
                                            <td class="px-4 py-2">{{ $session->is_paid ? 'Yes' : 'No' }}</td>
                                            <td class="px-4 py-2">{{ $session->session_link }}</td>
                                            <td class="px-4 py-2">
                                                <div class="flex gap-2">
                                                    @if (auth()->user()->role === 2 || auth()->user()->role === 3)
                                                        <!-- Dropdown for Mark as Paid -->
                                                        <div class="relative">
                                                            <button class="px-4 py-2 text-white rounded-full bg-healthymind-dark hover:bg-healhtymind-light">Actions</button>
                                                            <div class="absolute right-0 z-10 hidden w-48 mt-2 origin-top-right bg-white border rounded-md shadow-lg border-healthymind-bg">
                                                                <form action="{{ route('session.toggleIsPaid', $session->id) }}" method="POST" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="is_paid" value="{{ $session->is_paid ? 0 : 1 }}">
                                                                    <input type="url" name="session_link" placeholder="Enter session link" required class="w-full px-4 py-2 mb-2 border rounded-lg">
                                                                    <button type="submit" class="w-full px-4 py-2 mt-2 text-white rounded-full bg-healthymind-dark hover:bg-healthymind-light">{{ $session->is_paid ? 'Mark as Unpaid' : 'Mark as Paid' }}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <!-- Modal for Delete Confirmation -->
                                                    <button class="px-4 py-2 text-white bg-red-600 rounded-full hover:bg-red-700" onclick="document.getElementById('deleteModal-{{ $session->id }}').style.display='block'">Delete</button>
                                                    <div id="deleteModal-{{ $session->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                                            </div>
                                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                                            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                                                                    <div class="sm:flex sm:items-start">
                                                                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                            <h3 class="text-lg font-medium leading-6 text-gray-900">Delete Session</h3>
                                                                            <div class="mt-2">
                                                                                <p class="text-sm text-gray-500">Are you sure you want to delete this session? This action cannot be undone.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                    <form action="{{ route('session.destroy', $session->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                                                                    </form>
                                                                    <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm" onclick="document.getElementById('deleteModal-{{ $session->id }}').style.display='none'">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (auth()->user()->role === 1)
                                <div class="mt-6">
                                    <h2 class="text-lg font-semibold">How to Proceed with Payment</h2>
                                    <p class="mt-2 text-sm text-gray-600">To proceed with the payment for your therapy session, please follow these steps:</p>
                                    <ol class="mt-2 ml-4 text-sm text-gray-600 list-decimal list-inside">
                                        <li>Log in to your account on our payment portal.</li>
                                        <li>Navigate to the 'Payments' section.</li>
                                        <li>Turn of your device</li>
                                        <li>Pergi ke masjid, panti asuhan, atau charity terdekat dan donasikan sebesar 1 gazzilion USD</li>
                                        <li>Setelah selesai maka status payment akan berubah dan Anda akan menerima link room untuk therapy session Anda</li>
                                    </ol>
                                    <p class="mt-2 text-sm text-gray-600">If you encounter any issues, don't contact anyone and fix the code</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.relative button').forEach(button => {
                button.addEventListener('click', function () {
                    const dropdown = this.nextElementSibling;
                    dropdown.classList.toggle('hidden');
                });
            });
        });
    </script>
</x-app-layout>