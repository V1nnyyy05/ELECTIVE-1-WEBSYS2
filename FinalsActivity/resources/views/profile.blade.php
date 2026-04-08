@extends('layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="mb-4">Edit Profile</h4>
                    <form action="/profile/{{ $user->id }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small">Course</label>
                            <input type="text" class="form-control" name="course" value="{{ $user->course }}">
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Save Updates</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection