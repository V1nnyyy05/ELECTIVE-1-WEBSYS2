@extends('layouts.app')

@section('content')
<div class="row flex-grow-1 justify-content-center align-items-center">
    <div class="col-md-8 col-lg-7">
        <div class="card-modern p-5">
            <div class="text-center mb-5">
                <h3 class="fw-bold mb-1">Update Record</h3>
            </div>

            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Student Number</label>
                        <input type="text" name="student_number" class="form-control" value="{{ old('student_number', $student->student_number) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Program</label>
                        <select name="program" class="form-select" required>
                            <option value="BS in Information Technology" {{ $student->program == 'BS in Information Technology' ? 'selected' : '' }}>BS in Information Technology</option>
                            <option value="BS in Computer Science" {{ $student->program == 'BS in Computer Science' ? 'selected' : '' }}>BS in Computer Science</option>
                            <option value="BS in Information Systems" {{ $student->program == 'BS in Information Systems' ? 'selected' : '' }}>BS in Information Systems</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Major</label>
                        <select name="major" class="form-select" required>
                            <option value="Web & Mobile Technologies" {{ $student->major == 'Web & Mobile Technologies' ? 'selected' : '' }}>Web & Mobile Technologies</option>
                            <option value="Network Engineering" {{ $student->major == 'Network Engineering' ? 'selected' : '' }}>Network Engineering</option>
                            <option value="Software Engineering" {{ $student->major == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                            <option value="General" {{ $student->major == 'General' ? 'selected' : '' }}>General / None</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Year Level</label>
                        <select name="year_level" class="form-select" required>
                            <option value="1st Year" {{ $student->year_level == '1st Year' ? 'selected' : '' }}>1st Year</option>
                            <option value="2nd Year" {{ $student->year_level == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                            <option value="3rd Year" {{ $student->year_level == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                            <option value="4th Year" {{ $student->year_level == '4th Year' ? 'selected' : '' }}>4th Year</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold d-block">Profile Picture</label>
                        <div class="d-flex align-items-center gap-3">
                            @if($student->photo_path)
                            <img src="{{ asset('storage/' . $student->photo_path) }}" alt="Photo" class="img-avatar">
                            @endif
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-2 pt-4 border-top">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-dark btn-modern px-4">Cancel</a>
                    <button type="submit" class="btn btn-success btn-modern">Update Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection