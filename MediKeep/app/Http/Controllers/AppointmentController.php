<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User; // <-- Ensure this is imported!
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // ... index method ...

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        // Fetch everyone who is a patient from the single unified table
        $patients = User::where('role', 'patient')->orderBy('name')->get();
        
        return view('appointments.create', compact('patients'));
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        // Notice we are validating 'user_id' now, NOT 'patient_id'
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'appointment_time' => 'required|date',
            'reason' => 'required|string|max:255',
        ]);

        Appointment::create([
            'user_id' => $request->user_id, // Saving to user_id
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => 'Pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Appointment booked successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:Approved,Cancelled,Completed,Pending',
            'doctor_comment' => 'nullable|string|max:1000',
        ]);

        $appointment->update([
            'status' => $request->status,
            'doctor_comment' => $request->doctor_comment,
        ]);

        return redirect()->route('dashboard')->with('success', 'Appointment status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function complete(Appointment $appointment)
{
    $appointment->update([
        'status' => 'Completed'
    ]);

    return redirect()->route('dashboard')->with('success', 'Appointment marked as completed!');
}
}
