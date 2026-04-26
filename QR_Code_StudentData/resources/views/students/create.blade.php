@extends('layouts.app')

@section('content')
<div class="row flex-grow-1 justify-content-center align-items-center">
    <div class="col-md-8 col-lg-7">
        <div class="card-modern p-5">
            <div class="text-center mb-5">
                <h3 class="fw-bold mb-1">Register Student</h3>
            </div>

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Student Number</label>
                        <input type="text" name="student_number" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Program</label>
                        <select name="program" class="form-select" required>
                            <option value="" disabled selected>Select Program</option>
                            <option value="BS in Information Technology">BS in Information Technology</option>
                            <option value="BS in Computer Science">BS in Computer Science</option>
                            <option value="BS in Information Systems">BS in Information Systems</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Major</label>
                        <select name="major" class="form-select" required>
                            <option value="" disabled selected>Select Major</option>
                            <option value="Web & Mobile Technologies">Web & Mobile Technologies</option>
                            <option value="Network Engineering">Network Engineering</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="General">General / None</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Year Level</label>
                        <select name="year_level" class="form-select" required>
                            <option value="" disabled selected>Select Year</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Profile Picture</label>
                        <input type="file" name="photo" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-2 mt-2 pt-4 border-top">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-dark btn-modern px-4">Back</a>
                    <button type="submit" class="btn btn-success btn-modern">Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection