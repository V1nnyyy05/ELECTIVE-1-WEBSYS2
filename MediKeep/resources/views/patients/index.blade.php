<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Patient Directory') }}
            </h2>
            <a href="{{ route('patients.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700 transition font-bold">
                + Register New Patient
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-left border-collapse">
    <thead>
        <tr class="border-b bg-gray-50">
            <th class="p-3 text-sm font-semibold text-gray-700">Patient Name</th>
            <th class="p-3 text-sm font-semibold text-gray-700">Email / Portal Access</th>
            <th class="p-3 text-sm font-semibold text-gray-700">Gender</th>
            <th class="p-3 text-sm font-semibold text-gray-700">Age</th>
            <th class="p-3 text-sm font-semibold text-gray-700">Action</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($patients as $patient)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 text-sm font-bold text-gray-900">{{ $patient->name }}</td>
                <td class="p-3 text-sm text-gray-600">{{ $patient->email }}</td>
                <td class="p-3 text-sm text-gray-600">{{ $patient->gender ?? 'N/A' }}</td>
                <td class="p-3 text-sm text-gray-600">
                    {{ $patient->dob ? \Carbon\Carbon::parse($patient->dob)->age . ' yrs' : 'N/A' }}
                </td>
                <td class="p-3 text-sm">
                    <a href="{{ route('patients.edit', $patient->id) }}" class="text-blue-600 hover:text-blue-900 font-bold text-xs uppercase tracking-wider">Edit</a>                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-12 text-center text-gray-400 italic text-sm">
                    No patients registered in the system yet.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>