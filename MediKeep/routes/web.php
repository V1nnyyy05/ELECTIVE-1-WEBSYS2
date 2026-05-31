<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// 1. The Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. The Smart Dashboard (Unified Architecture)
Route::get('/dashboard', function (Request $request) {
    $user = Auth::user();
    
    // STAFF / ADMIN LOGIC
    if ($user->role === 'admin') {
        
        // 1. Auto-expire past pending appointments
        \App\Models\Appointment::where('status', 'Pending')
            ->where('appointment_time', '<', now())
            ->update(['status' => 'Expired']);

        // 2. Filter Inputs
        $filterType = $request->input('filter_type', 'month'); // Defaults to month
        $selectedMonth = $request->input('month_filter', now()->format('Y-m')); 
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $statusFilter = $request->input('status');
        $searchTerm = $request->input('search');

        // 3. Base Query
        $appointmentQuery = \App\Models\Appointment::with(['user']);

        // 4. Apply Date Filters based on selected type
        if ($filterType === 'range' && $startDate && $endDate) {
            // Range Filter (e.g. May 15 to May 20)
            $appointmentQuery->whereBetween('appointment_time', [
                $startDate . ' 00:00:00', 
                $endDate . ' 23:59:59'
            ]);
            $parsedDate = \Carbon\Carbon::parse($startDate);
        } else {
            // Monthly Filter (Fallback/Default)
            [$year, $month] = explode('-', $selectedMonth);
            $appointmentQuery->whereMonth('appointment_time', $month)
                             ->whereYear('appointment_time', $year);
            $parsedDate = \Carbon\Carbon::parse($selectedMonth . '-01');
        }

        $chartYear = $parsedDate->year;
        $chartMonth = $parsedDate->month;

        // Apply Status Filter
        if ($statusFilter) {
            $appointmentQuery->where('status', $statusFilter);
        }

        // Apply Smart Search
        if ($searchTerm) {
            $appointmentQuery->where(function ($query) use ($searchTerm) {
                $query->where('reason', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('user', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        $filteredAppointments = $appointmentQuery->orderBy('appointment_time', 'asc')->get();

        // 5. Global Dashboard Card Stats
        $totalPatients = \App\Models\User::where('role', 'patient')->count();
        $totalAppointments = \App\Models\Appointment::count();
        $pendingToday = \App\Models\Appointment::whereDate('appointment_time', today())
            ->where('status', 'Pending')
            ->count();

        // 6. Generate Chart Data (NOW RESPECTS DATE RANGE!)
        $usersChartQuery = \App\Models\User::where('role', 'patient');
        $appointmentsChartQuery = \App\Models\Appointment::where('status', 'Completed');

        if ($filterType === 'range' && $startDate && $endDate) {
            $usersChartQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $appointmentsChartQuery->whereBetween('appointment_time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } else {
            $usersChartQuery->whereMonth('created_at', $chartMonth)->whereYear('created_at', $chartYear);
            $appointmentsChartQuery->whereMonth('appointment_time', $chartMonth)->whereYear('appointment_time', $chartYear);
        }

        $usersByDay = $usersChartQuery
            ->selectRaw('DATE_FORMAT(created_at, "%b %d") as day_label, count(*) as count')
            ->groupBy('day_label')
            ->pluck('count', 'day_label')->toArray();

        $appointmentsByDay = $appointmentsChartQuery
            ->selectRaw('DATE_FORMAT(appointment_time, "%b %d") as day_label, count(*) as count')
            ->groupBy('day_label')
            ->pluck('count', 'day_label')->toArray();

        $chartLabels = array_unique(array_merge(array_keys($usersByDay), array_keys($appointmentsByDay)));
        sort($chartLabels);

        $userData = [];
        $appointmentData = [];
        foreach ($chartLabels as $label) {
            $userData[] = $usersByDay[$label] ?? 0;
            $appointmentData[] = $appointmentsByDay[$label] ?? 0;
        }

        // 7. CALCULATE DEMOGRAPHICS
        $allPatients = \App\Models\User::where('role', 'patient')->get(['gender', 'dob']);

        $genderStats = ['Male' => 0, 'Female' => 0];
        $ageStats = ['1-10' => 0, '11-20' => 0, '21-30' => 0, '31-40' => 0, '41-50' => 0, '51-60' => 0, 'Senior' => 0];

        foreach($allPatients as $person) {
            if($person->gender === 'Male') $genderStats['Male']++;
            if($person->gender === 'Female') $genderStats['Female']++;

            if($person->dob) {
                $age = \Carbon\Carbon::parse($person->dob)->age;
                if($age <= 10) $ageStats['1-10']++;
                elseif($age <= 20) $ageStats['11-20']++;
                elseif($age <= 30) $ageStats['21-30']++;
                elseif($age <= 40) $ageStats['31-40']++;
                elseif($age <= 50) $ageStats['41-50']++;
                elseif($age <= 60) $ageStats['51-60']++;
                else $ageStats['Senior']++;
            }
        }

       return view('dashboard', compact(
            'filteredAppointments', 'totalPatients', 'totalAppointments', 'pendingToday',
            'filterType', 'selectedMonth', 'startDate', 'endDate', 
            'statusFilter', 'searchTerm', 'chartLabels', 'userData', 'appointmentData',
            'genderStats', 'ageStats'
        ));
    }

    // PATIENT LOGIC
    $myAppointments = \App\Models\Appointment::where('user_id', $user->id)
        ->latest()
        ->get();
        
    return view('patient-dashboard', compact('myAppointments'));

})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Authenticated Access System Group
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('appointments', AppointmentController::class);

    // 4. Secure Admin-Only Privilege Group
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::resource('patients', PatientController::class);
        
        Route::get('/staff/create', [ProfileController::class, 'createStaff'])->name('staff.create');
        Route::post('/staff', [ProfileController::class, 'storeStaff'])->name('staff.store');

        Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])
            ->name('appointments.updateStatus');
    });
});

require __DIR__.'/auth.php';