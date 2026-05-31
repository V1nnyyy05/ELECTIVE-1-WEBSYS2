<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a unified listing of the resource.
     */
    public function index()
    {
        // Query EVERYONE who is a patient from the single unified users table
        $patients = User::where('role', 'patient')->latest()->get();
        
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new walk-in patient.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created patient in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date',
        ]);

        // Create a User account for the walk-in patient
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'role' => 'patient',
            // Default password so they can log into the portal later!
            'password' => Hash::make('MediKeep2026'), 
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Patient added successfully! Their temporary password is MediKeep2026');
    }

    /**
     * Show the form for editing a unified patient record.
     */
    public function edit(User $patient) // Notice we typehint User, but pass it as $patient
    {
        // Ensure the admin doesn't accidentally try to edit another Admin through this route
        if ($patient->role !== 'patient') {
            return redirect()->route('patients.index')->with('error', 'You can only edit patient records here.');
        }

        return view('patients.edit', compact('patient'));
    }

    /**
     * Update a unified patient record.
     */
    public function update(Request $request, User $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $patient->id,
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Patient record updated successfully!');
    }

    /**
     * Remove a unified patient record.
     */
    public function destroy(User $patient)
    {
        // Safety check
        if ($patient->id === Auth::id() || $patient->role === 'admin') {
            return back()->with('error', 'Critical Error: You cannot delete admin accounts here.');
        }

        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient Record Successfully Deleted!');
    }
}