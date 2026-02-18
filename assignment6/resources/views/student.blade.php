<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT PROFILE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            padding: 20px;
            width: 100%;
            max-width: 400px;
        }
        .card-title {
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -0.5px;
            margin-bottom: 0;
            text-transform: uppercase;
            font-size: 1.25rem;
        }
        hr {
            border-top: 1px solid #e9ecef;
            opacity: 1;
            margin: 1.5rem 0;
        }
        .info-row {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        .info-label {
            font-weight: 700;
            color: #111;
            margin-right: 8px;
        }
        .info-value {
            color: #555;
            font-weight: 400;
        }
    </style>
</head>
<body class="vh-100 d-flex justify-content-center align-items-center">

    <div class="card bg-white">
        <div class="card-body text-start">
            <h1 class="card-title">Student Profile</h1>
            <hr>
            <div class="info-row">
                <span class="info-label">Student ID:</span>
                <span class="info-value">{{ $id }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ strtoupper($name) }}</span>
            </div>
        </div>
    </div>
    
</body>
</html>