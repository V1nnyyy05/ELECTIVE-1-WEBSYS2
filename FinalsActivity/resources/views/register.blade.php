@extends('layout')
@section('content')
<div class="card shadow-sm max-w-md mx-auto" style="max-width: 600px;">
    <div class="card-header bg-primary text-white"><h4>Student Registration</h4></div>
    <div class="card-body">
        <form action="/register" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3"><label>Student ID</label><input type="text" name="student_id" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Course</label><input type="text" name="course" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>First Name</label><input type="text" name="first_name" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Last Name</label><input type="text" name="last_name" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Date of Birth</label><input type="date" name="dob" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option>Male</option><option>Female</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3"><label>Contact Number</label><input type="text" name="contact_number" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Address</label><input type="text" name="address" class="form-control" required></div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</div>
@endsection