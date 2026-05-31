<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book New Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg shadow-sm">
                            <ul class="list-disc pl-5 text-sm font-bold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        @if(Auth::user()->role === 'admin')
                            <label for="user_id" class="block text-sm font-bold text-gray-700 mb-1">Select Patient</label>
                            <select name="user_id" id="user_id" required class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
                                <option value="" disabled selected>-- Choose a Patient --</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ request('user_id') == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }} ({{ $patient->email }})
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <label class="block text-sm font-bold text-gray-700 mb-1">Booking for</label>
                            <div class="mt-1 p-3 bg-blue-50 border border-blue-200 rounded-lg text-blue-800 font-semibold text-sm cursor-not-allowed">
                                {{ Auth::user()->name }}
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        @endif
                    </div>

                    <div class="mt-4">
                        <label for="appointment_time" class="block font-medium text-sm text-gray-700 font-bold mb-1">Appointment Date & Time</label>
                        <input type="datetime-local" name="appointment_time" id="appointment_time" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm block mt-1 w-full text-sm" required>
                    </div>

                    <div class="mt-4">
                        <label for="reason" class="block font-medium text-sm text-gray-700 font-bold mb-1">Reason for Visit</label>
                        <textarea name="reason" id="reason" rows="3" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm block mt-1 w-full text-sm" placeholder="e.g. Annual Checkup" required></textarea>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                            Confirm Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>