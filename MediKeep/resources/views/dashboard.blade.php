<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight shrink-0">
                {{ __('Admin Dashboard Analytics') }}
            </h2>
            
            <form id="filterForm" method="GET" action="{{ route('dashboard') }}" class="w-full xl:w-auto flex flex-col sm:flex-row items-stretch sm:items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-200">
                <div class="relative flex-1 sm:w-64">
                    <input type="text" name="search" placeholder="Search patient name or reason..." value="{{ $searchTerm ?? '' }}"
                        class="w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg text-sm text-gray-700 pl-3 pr-8 py-1.5 font-medium">
                </div>

                <select name="status" onchange="document.getElementById('filterForm').submit();"
                    class="border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg text-sm text-gray-600 font-semibold py-1.5 pl-3 pr-8">
                    <option value="">All Statuses</option>
                    <option value="Pending" {{ ($statusFilter ?? '') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ ($statusFilter ?? '') === 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Completed" {{ ($statusFilter ?? '') === 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ ($statusFilter ?? '') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="Expired" {{ ($statusFilter ?? '') === 'Expired' ? 'selected' : '' }}>Expired</option>
                </select>

                <div class="flex items-center gap-2 border-t sm:border-t-0 sm:border-l pt-2 sm:pt-0 sm:pl-3 border-gray-100">
                    
                    <select name="filter_type" id="filter_type" onchange="toggleDateInputs()" class="border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg text-xs text-gray-600 font-bold py-1.5 pl-2 pr-6">
                        <option value="month" {{ $filterType === 'month' ? 'selected' : '' }}>Monthly</option>
                        <option value="range" {{ $filterType === 'range' ? 'selected' : '' }}>Date Range</option>
                    </select>

                    <div id="month_container" class="{{ $filterType === 'range' ? 'hidden' : 'flex' }} items-center">
                        <input type="month" name="month_filter" value="{{ $selectedMonth }}" 
                            class="w-full sm:w-auto border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg text-xs text-gray-700 font-bold py-1.5 px-2">
                    </div>

                    <div id="range_container" class="{{ $filterType === 'month' ? 'hidden' : 'flex' }} items-center gap-2">
                        <input type="date" name="start_date" value="{{ $startDate }}" 
                            class="w-full sm:w-auto border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg text-xs text-gray-700 font-bold py-1.5 px-2">
                        <span class="text-gray-400 text-xs font-bold uppercase">To</span>
                        <input type="date" name="end_date" value="{{ $endDate }}" 
                            class="w-full sm:w-auto border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg text-xs text-gray-700 font-bold py-1.5 px-2">
                    </div>

                    <button type="submit" class="bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 font-bold py-1.5 px-3 rounded-lg text-xs transition">
                        Filter
                    </button>
                    
                    <a href="{{ route('dashboard') }}" class="text-xs text-gray-400 hover:text-gray-600 font-bold ml-1 transition">Reset</a>
                </div>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">
                    
                    <div class="flex justify-between items-center mt-6">
                        <h3 class="text-lg font-bold text-gray-800">
                            Appointments Schedule Overview 
                            <span class="text-blue-600">
                                @if($filterType === 'range' && $startDate && $endDate)
                                    ({{ \Carbon\Carbon::parse($startDate)->format('m/d/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('m/d/Y') }})
                                @else
                                    ({{ \Carbon\Carbon::parse($selectedMonth . '-01')->format('F Y') }})
                                @endif
                            </span>
                        </h3>
                        <a href="{{ route('appointments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition font-semibold text-sm">
                            + Add Appointment
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded shadow-sm">
                            <p class="text-xs font-bold text-blue-600 tracking-wider uppercase">Total Patients Base</p>
                            <p class="text-3xl font-black text-gray-900 mt-1">{{ $totalPatients }}</p>
                        </div>
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm">
                            <p class="text-xs font-bold text-green-600 tracking-wider uppercase">Total System Bookings</p>
                            <p class="text-3xl font-black text-gray-900 mt-1">{{ $totalAppointments }}</p>
                        </div>
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded shadow-sm">
                            <p class="text-xs font-bold text-yellow-600 tracking-wider uppercase">Pending Tasks Today</p>
                            <p class="text-3xl font-black text-gray-900 mt-1">{{ $pendingToday }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-100">
                        <div class="relative w-full h-64">
                            <canvas id="medikeepAnalyticsChart"></canvas>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-100 col-span-1">
                            <h4 class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider text-center">Patient Gender</h4>
                            <div class="relative w-full h-56">
                                <canvas id="genderChart"></canvas>
                            </div>
                        </div>

                        <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-100 col-span-1 lg:col-span-2">
                            <h4 class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider text-center">Age Demographics</h4>
                            <div class="relative w-full h-56">
                                <canvas id="ageChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto border border-gray-100 rounded-xl mt-6">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="p-3 text-sm font-semibold text-gray-700">Scheduled Time</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Patient Name</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Reason / Notes</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Status</th>
                                    <th class="p-3 text-sm font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($filteredAppointments as $appointment)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="p-3 text-sm font-medium text-gray-600">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('l, M d - h:i A') }}
                                        </td>
                                        <td class="p-3 text-sm font-semibold text-gray-900">
                                            {{ $appointment->user->name ?? 'Unlinked Record' }}
                                        </td>
                                        <td class="p-3 text-sm text-gray-600">
                                            <div>{{ $appointment->reason }}</div>
                                            @if($appointment->doctor_comment)
                                                <div class="text-xs text-indigo-600 mt-1 italic font-medium">Doc: "{{ $appointment->doctor_comment }}"</div>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            @php
                                                $statusClasses = [
                                                    'Pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                    'Approved' => 'bg-purple-100 text-purple-800 border-purple-200',
                                                    'Completed' => 'bg-green-100 text-green-800 border-green-200',
                                                    'Cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                                    'Expired' => 'bg-gray-100 text-gray-600 border-gray-300',
                                                ];
                                                $currentClass = $statusClasses[$appointment->status] ?? 'bg-blue-100 text-blue-800';
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $currentClass }}">
                                                {{ $appointment->status }}
                                            </span>
                                        </td>
                                        <td class="p-3 text-sm">
                                            @if($appointment->status === 'Pending' || $appointment->status === 'Approved')
                                                <button type="button" 
                                                    data-id="{{ $appointment->id }}"
                                                    data-name="{{ $appointment->user->name ?? 'Unlinked Record' }}"
                                                    data-comment="{{ $appointment->doctor_comment ?? '' }}"
                                                    onclick="openStatusModal(this)" 
                                                    class="text-blue-600 hover:text-blue-900 font-bold text-xs uppercase tracking-wider transition">
                                                    Continue
                                                </button>
                                            @elseif($appointment->status === 'Completed')
                                                <a href="{{ route('appointments.create', ['user_id' => $appointment->user_id]) }}" 
                                                    class="text-green-600 hover:text-green-900 font-bold text-xs uppercase tracking-wider transition">
                                                    Follow-up
                                                </a>
                                            @else
                                                <span class="text-gray-400 italic text-xs">No pending actions</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-12 text-center text-gray-400 italic text-sm">
                                            No appointments found for the selected filter.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="statusModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden border border-gray-100 transform transition-all">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800 text-md">Clinical Evaluation Portal</h3>
                <button type="button" onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 font-bold text-sm">✕</button>
            </div>
            
            <form id="modalStatusForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" id="formStatusValue" value="">

                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Patient Selected</p>
                        <p id="modalPatientName" class="text-base font-bold text-gray-900 mt-0.5">Patient Name</p>
                    </div>

                    <div>
                        <label for="doctor_comment" class="block text-xs font-bold text-indigo-600 uppercase tracking-wider mb-1">Prescription Details & Follow-up Instructions</label>
                        <textarea name="doctor_comment" id="modalDoctorComment" rows="4" 
                            placeholder="Type prescriptions, cancellation reasons, or schedule update notices here..."
                            class="w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm font-medium placeholder:text-gray-400"></textarea>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100 flex flex-wrap gap-2 justify-end">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-xs font-bold text-gray-500 hover:text-gray-700 uppercase tracking-wider transition">
                        Dismiss
                    </button>
                    <button type="button" onclick="submitWithStatus('Cancelled')" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg uppercase tracking-wider shadow-sm transition">
                        Cancel
                    </button>
                    <button type="button" onclick="submitWithStatus('Approved')" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold rounded-lg uppercase tracking-wider shadow-sm transition">
                        Approve
                    </button>
                    <button type="button" onclick="submitWithStatus('Completed')" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-lg uppercase tracking-wider shadow-sm transition">
                        Complete
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Toggles the Date Inputs based on the Dropdown selection
        function toggleDateInputs() {
            const filterType = document.getElementById('filter_type').value;
            const monthContainer = document.getElementById('month_container');
            const rangeContainer = document.getElementById('range_container');

            if (filterType === 'range') {
                monthContainer.classList.add('hidden');
                monthContainer.classList.remove('flex');
                rangeContainer.classList.remove('hidden');
                rangeContainer.classList.add('flex');
            } else {
                rangeContainer.classList.add('hidden');
                rangeContainer.classList.remove('flex');
                monthContainer.classList.remove('hidden');
                monthContainer.classList.add('flex');
            }
        }

        // Modal Functions
        function openStatusModal(button) {
            const appointmentId = button.getAttribute('data-id');
            const patientName = button.getAttribute('data-name');
            const currentComment = button.getAttribute('data-comment');
            
            const modal = document.getElementById('statusModal');
            const form = document.getElementById('modalStatusForm');
            
            form.action = `/appointments/${appointmentId}/status`;
            document.getElementById('modalPatientName').innerText = patientName;
            document.getElementById('modalDoctorComment').value = currentComment || '';
            
            modal.classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        function submitWithStatus(statusValue) {
            document.getElementById('formStatusValue').value = statusValue;
            document.getElementById('modalStatusForm').submit();
        }

        // Charts Rendering
        document.addEventListener("DOMContentLoaded", function () {
            // 1. MAIN PERFORMANCE CHART
            const mainCtx = document.getElementById('medikeepAnalyticsChart').getContext('2d');
            const labels = JSON.parse('{!! json_encode($chartLabels ?? []) !!}');
            const userData = JSON.parse('{!! json_encode($userData ?? []) !!}');
            const appointmentData = JSON.parse('{!! json_encode($appointmentData ?? []) !!}');

            new Chart(mainCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        { 
                            label: 'New Patients Registered', 
                            data: userData, 
                            borderColor: '#3b82f6', 
                            backgroundColor: 'rgba(59, 130, 246, 0.25)', 
                            borderWidth: 2, 
                            tension: 0.4, 
                            fill: true,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#3b82f6',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        { 
                            label: 'Completed Appointments', 
                            data: appointmentData, 
                            borderColor: '#22c55e', 
                            backgroundColor: 'rgba(34, 197, 94, 0.25)', 
                            borderWidth: 2, 
                            tension: 0.4, 
                            fill: true,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#22c55e',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }
                    ]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } },
                        tooltip: { backgroundColor: 'rgba(17, 24, 39, 0.9)' }
                    },
                    scales: { 
                        y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0, 0, 0, 0.1)', borderDash: [5, 5] } },
                        x: { grid: { display: true, color: 'rgba(0, 0, 0, 0.1)', borderDash: [5, 5] } }
                    }
                }
            });

            // 2. GENDER DOUGHNUT CHART
            const genderCtx = document.getElementById('genderChart').getContext('2d');
            const genderStatsRaw = JSON.parse('{!! json_encode($genderStats ?? ["Male" => 0, "Female" => 0]) !!}');
            
            new Chart(genderCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        data: [genderStatsRaw['Male'] || 0, genderStatsRaw['Female'] || 0],
                        backgroundColor: ['rgba(59, 130, 246, 0.85)', 'rgba(236, 72, 153, 0.85)'], 
                        borderWidth: 0, hoverOffset: 4
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, cutout: '65%' }
            });

            // 3. AGE DISTRIBUTION BAR CHART
            const ageCtx = document.getElementById('ageChart').getContext('2d');
            const ageStatsRaw = JSON.parse('{!! json_encode($ageStats ?? []) !!}');
            
            new Chart(ageCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(ageStatsRaw),
                    datasets: [{
                        label: 'Total Patients',
                        data: Object.values(ageStatsRaw),
                        backgroundColor: 'rgba(99, 102, 241, 0.85)',
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { borderDash: [5, 5] } }, x: { grid: { display: false } } }
                }
            });
        });
    </script>
</x-app-layout>