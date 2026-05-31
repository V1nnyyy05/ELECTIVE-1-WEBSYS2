<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-blue-600 rounded-3xl p-8 text-white shadow-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div>
                    <h3 class="text-3xl font-bold mb-2">Need a Checkup?</h3>
                    <p class="text-blue-100 font-medium">Book your appointment in less than a minute.</p>
                </div>
                <a href="{{ route('appointments.create') }}" class="w-full sm:w-auto text-center bg-white text-blue-600 px-8 py-4 rounded-2xl font-black hover:bg-blue-50 transition transform hover:scale-105 shadow-md">
                    + Start New Appointment
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8 border border-gray-100">
                <h4 class="text-xl font-bold text-gray-800 mb-6">Your Recent Visits & Consultations</h4>
                
                <div class="divide-y divide-gray-100">
                    @forelse($myAppointments as $appointment)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between py-6 gap-4">
                            <div class="flex-1 space-y-1.5">
                                <p class="font-bold text-gray-900 text-base tracking-tight">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('l, M d, Y - h:i A') }}
                                </p>
                                <p class="text-sm text-gray-500 font-medium">{{ $appointment->reason }}</p>
                                
                                @if($appointment->doctor_comment)
                                    <div class="mt-3 p-3.5 bg-indigo-50/50 border border-indigo-100 rounded-2xl text-xs text-indigo-900 font-medium max-w-2xl">
                                        <span class="font-bold text-indigo-700 block mb-1 uppercase tracking-wider text-[10px]">Message from Clinic Staff:</span>
                                        "{{ $appointment->doctor_comment }}"
                                    </div>
                                @endif
                            </div>

                            <div class="shrink-0 flex items-start sm:items-center">
                                @php
                                    $statusClasses = [
                                        'Pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        'Approved' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        'Completed' => 'bg-green-50 text-green-700 border-green-200',
                                        'Cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                        'Expired' => 'bg-gray-50 text-gray-500 border-gray-200',
                                    ];
                                    $currentClass = $statusClasses[$appointment->status] ?? 'bg-blue-50 text-blue-700 border-blue-200';
                                @endphp
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold border uppercase tracking-wider {{ $currentClass }}">
                                    {{ $appointment->status }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-400 italic text-sm">You haven't booked any medical consultations yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>