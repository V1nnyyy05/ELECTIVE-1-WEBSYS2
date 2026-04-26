<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa; /* Very light grey */
        font-family: 'Inter', sans-serif;
        color: #1a1a1a; /* Near black */
    }

    /* Main Container Card */
    .card-modern {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    /* Inputs and Selects */
    .form-control,
    .form-select {
        border-radius: 6px;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        background-color: #ffffff;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        border-color: #000000;
    }

    /* Buttons */
    .btn-modern {
        padding: 0.6rem 1.5rem;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .btn-black {
        background-color: #000000;
        color: #ffffff;
        border: none;
    }

    .btn-black:hover {
        background-color: #333333;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Table Styling */
    .table thead th {
        background-color: #f1f1f1;
        color: #666666;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        border-top: none;
    }

    .table td {
        vertical-align: middle;
        border-bottom: 1px solid #eeeeee;
    }

    /* Profile Avatar */
    .img-avatar {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #ffffff;
        box-shadow: 0 0 0 1px #e0e0e0;
    }

    /* Labels and Values */
    .info-label {
        font-size: 0.65rem;
        color: #888888;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: #000000;
    }

    /* Search Bar Customization */
    .search-group {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: #ffffff;
        overflow: hidden;
    }

    .search-input {
        border: none !important;
        background: transparent !important;
    }
</style>
</head>

<body>
    <div class="d-flex flex-column min-vh-100">
        <div class="container py-5 flex-grow-1 d-flex flex-column">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="border-radius: 8px;" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>