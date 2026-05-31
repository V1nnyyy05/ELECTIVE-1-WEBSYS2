<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Patient Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('patients.update', $patient->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required
                            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Address (Portal Login)</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" required
                            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="dob" class="block text-sm font-bold text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="{{ old('dob', $patient->dob ? $patient->dob->format('Y-m-d') : '') }}" required
                            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
                    </div>

                    <div class="mb-6">
                        <label for="gender" class="block text-sm font-bold text-gray-700 mb-1">Gender</label>
                        <select name="gender" id="gender" required
                            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
                            <option value="Male" {{ old('gender', $patient->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $patient->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('patients.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-bold transition">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                            Update Patient
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>