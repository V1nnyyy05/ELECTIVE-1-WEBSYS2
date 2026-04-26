@extends('layouts.app')

@section('content')

<div class="row flex-grow-1 justify-content-center align-items-center mt-3">
    <div class="col-lg-10 col-xl-8">
        <div class="card-modern overflow-hidden" style="border-radius: 20px;">
            <div class="row g-0">

                <div class="col-md-7 p-4 p-md-5">

                    <div class="d-flex align-items-center gap-4 mb-5">
                        @if($student->photo_path)
                        <img src="{{ asset('storage/' . $student->photo_path) }}" alt="Profile" class="rounded-circle shadow-sm flex-shrink-0" style="width: 90px; height: 90px; object-fit: cover;">
                        @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-muted shadow-sm flex-shrink-0" style="width: 90px; height: 90px;">
                            <span style="font-size: 0.75rem;">No Photo</span>
                        </div>
                        @endif

                        <div>
                            <h4 class="fw-bold mb-1 text-dark lh-sm">{{ $student->name }}</h4>
                            <p class="text-muted fw-mb mb-0">{{ $student->student_number }}</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 border-bottom pb-3">
                            <span class="info-label">Program</span>
                            <span class="info-value">{{ $student->program }}</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="info-label">Major</span>
                            <span class="info-value">{{ $student->major }}</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="info-label">Year Level</span>
                            <span class="info-value">{{ $student->year_level }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 bg-white d-flex flex-column justify-content-center align-items-center p-4 p-md-5 border-start">
                    <span class="badge bg-white text-secondary border px-3 py-2 shadow-sm mb-4 fw-semibold rounded-pill">QR CODE</span>
                    <div class=" bg-light p-3 rounded-4 shadow-sm border mb-4 qr-wrapper" style="max-width: 160px; width: 100%;">
                        {!! $qr !!}
                    </div>

                    <p class="text-muted  small text-center mb-0 px-2 fw-medium">Scan to view student details.</p>

                </div>

            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('students.index') }}" class="btn btn-dark btn-modern">Back</a>
        </div>


    </div>
</div>
@endsection