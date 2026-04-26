@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mx-auto" style="max-width: 500px;">
    <div class="card-body text-center p-5">
        <h3 class="fw-light mb-1">{{ $student->name }}</h3>
        <p class="text-muted mb-4">{{ $student->student_number }} | {{ $student->program }}</p>

        <div class="p-3 bg-white border rounded d-inline-block mb-4 shadow-sm">
            {!! $qr !!}
        </div>

        <p class="small text-muted mb-4">Scan the QR code to view student details.</p>

        <a href="{{ route('students.index') }}" class="btn btn-dark w-100">Back</a>
    </div>
</div>
@endsection