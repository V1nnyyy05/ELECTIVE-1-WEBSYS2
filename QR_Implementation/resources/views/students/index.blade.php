@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="m-0 fw-light">Students</h2>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form action="{{ route('students.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search by ID or Name..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary px-3">Search</button>
            <a href="{{ route('students.index') }}" class="btn btn-link text-decoration-none">Clear</a>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>QR Code</th>
                <th>Student No.</th>
                <th>Name</th>
                <th>Program</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td>{!! $student->qr !!}</td>
                <td>{{ $student->student_number }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->program }}</td>
                <td class="text-end">
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-success text-white">View Data</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-muted">No students found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection