<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('student_number', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('program', 'LIKE', "%{$search}%");
        }

        $students = $query->latest()->get()->map(function ($student) {
            $student->qr = QrCode::size(80)->margin(1)->generate(route('students.show', $student->id));
            return $student;
        });

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_number' => 'required|unique:students',
            'name' => 'required',
            'program' => 'required',
            'major' => 'required',
            'year_level' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('student_photos', 'public');
        }

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $qrData = json_encode([
            'ID' => $student->student_number,
            'Name' => $student->name,
            'Program' => $student->program,
            'Major' => $student->major,
            'Year' => $student->year_level
        ]);

        $qr = QrCode::size(200)->margin(1)->generate($qrData);

        return view('students.show', compact('student', 'qr'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_number' => 'required|unique:students,student_number,' . $student->id,
            'name' => 'required',
            'program' => 'required',
            'major' => 'required',
            'year_level' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($student->photo_path) {
                Storage::disk('public')->delete($student->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('student_photos', 'public');
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student removed.');
    }
}
