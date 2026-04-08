<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 5</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-sm" style="width: 420px;">

        <div class="card-header bg-white text-center border-bottom">
            <h5 class="mb-1 fw-semibold">Student Evaluation</h5>
            <small class="text-muted">Academic Summary</small>
        </div>

        <div class="card-body">

            <div class="mb-3 pb-2 border-bottom">
                <span class="text-muted small">Student Name</span>
                <div class="fw-semibold">{{ $name }}</div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Prelim</span>
                    <span>{{ $prelim }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Midterm</span>
                    <span>{{ $midterm }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Final</span>
                    <span>{{ $final }}</span>
                </div>
            </div>

            <hr class="my-3">

            @php
                $average = ($prelim + $midterm + $final) / 3;
            @endphp

            <div class="d-flex justify-content-between mb-2">
                <span class="fw-semibold">Average</span>
                <span class="fw-bold">{{ number_format($average, 2) }}</span>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span class="fw-semibold">Grade</span>
                <span>
                    @if($average >= 90) A
                    @elseif($average >= 80) B
                    @elseif($average >= 70) C
                    @elseif($average >= 60) D
                    @else F
                    @endif
                </span>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span class="fw-semibold">Remarks</span>
                <span class="{{ $average >= 75 ? 'text-success' : 'text-danger' }}">
                    {{ $average >= 75 ? 'Passed' : 'Failed' }}
                </span>
            </div>

            <div class="d-flex justify-content-between">
                <span class="fw-semibold">Award</span>
                <span class="text-muted">
                    @if($average >= 98) With Highest Honors
                    @elseif($average >= 95) With High Honors
                    @elseif($average >= 90) With Honors
                    @else No Award
                    @endif
                </span>
            </div>

        </div>

    </div>

</body>
</html>
