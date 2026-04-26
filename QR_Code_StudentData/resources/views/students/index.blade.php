@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h2 class="fw-bold m-0" style="letter-spacing: -1px; color: #000;">Students</h2>
        <p class="text-muted m-0 mt-1" style="font-size: 0.9rem;">Manage and view student QR profiles.</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-modern btn-black">Add Student</a>
</div>

<div class="card-modern mb-4">
    <form action="{{ route('students.index') }}" method="GET" class="d-flex p-1">
        <div class="input-group search-group">
            <span class="input-group-text bg-transparent border-0 pe-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#64748b" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </span>
            <input type="text" name="search" class="form-control search-input shadow-none" placeholder="Search by student ID, name, or course..." value="{{ request('search') }}">
            
            @if(request('search'))
                <a href="{{ route('students.index') }}" class="btn btn-light d-flex align-items-center text-muted px-3 border-0 bg-transparent">Clear</a>
            @endif
            
            <button type="submit" class="btn btn-modern btn-black px-4 m-1" style="border-radius: 4px;">Search</button>
        </div>
    </form>
</div>

<div class="card-modern overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Picture</th>
                    <th>QR Code</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Major</th>
                    <th class="text-nowrap">Year Level</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td class="ps-4">
                        <img src="{{ asset('storage/' . $student->photo_path) }}" class="img-avatar" alt="Profile">
                    </td>
                    <td>
                        <div class="qr-wrapper" style="width: 50px;">
                            {!! $student->qr !!}
                        </div>
                    </td>
                    <td><span class="info-value">{{ $student->student_number }}</span></td>
                    <td><span class="info-value">{{ $student->name }}</span></td>
                    <td><span class="info-value">{{ $student->program }}</span></td>
                    <td><span class="info-value text-muted" style="font-size: 0.85rem;">{{ $student->major }}</span></td>
                    <td><span class="badge bg-light text-dark border">{{ $student->year_level }}</span></td>
                    <td class="text-end pe-4 text-nowrap">
                        <div class="btn-group shadow-sm" style="border-radius: 6px; overflow: hidden;">
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-white border-end px-3">View</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-white border-end px-3">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-white text-danger px-3" onclick="return confirm('Delete this record?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <div class="py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#e2e8f0" class="bi bi-person-exclamation mb-3" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5Zm0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z"/>
                            </svg>
                            <p class="text-muted">No student records match your search.</p>
                            <a href="{{ route('students.index') }}" class="btn btn-link text-decoration-none btn-sm">Refresh list</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection