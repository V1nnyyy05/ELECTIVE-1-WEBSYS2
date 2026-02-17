<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 5</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .evaluation-card {
            background-color: white;
            width: 350px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .card-header h4 {
            margin: 0;
            color: #333;
        }

        .card-text {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #555;
        }

        .card-text b {
            color: #000;
        }

        hr {
            border: 0;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        .status-passed {
            color: green;
            font-weight: bold;
        }

        .status-failed {
            color: red;
            font-weight: bold;
        }

        .card-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>

    <div class="evaluation-card">
        <div class="card-header">
            <h4>Student Evaluation</h4>
        </div>

        <div class="card-body">
            <p class="card-text"><b>Name:</b> {{ $name }}</p>
            <p class="card-text"><b>Prelim:</b> {{ $prelim }}</p>
            <p class="card-text"><b>Midterm:</b> {{ $midterm }}</p>
            <p class="card-text"><b>Final:</b> {{ $final }}</p>
            
            <hr>

            @php
                $average = ($prelim + $midterm + $final)/3;
            @endphp

            <p class="card-text"><b>Average:</b> {{ number_format($average, 2) }}</p>

            <p class="card-text"><b>Letter Grade: </b>
                @if($average >= 90) A
                @elseif($average >= 80) B
                @elseif($average >= 70) C
                @elseif($average >= 60) D
                @else F
                @endif
            </p>

            <p class="card-text"><b>Remarks:</b>
                @if($average >= 75)
                    <span class="status-passed">Passed</span>
                @else
                    <span class="status-failed">Failed</span>
                @endif
            </p>

            <p class="card-text"><b>Award:</b>
                @if($average >= 98) With Highest Honors
                @elseif($average >= 95) With High Honors
                @elseif($average >= 90) With Honors
                @else No Award
                @endif
            </p>
        </div>


    </div>

</body>
</html>