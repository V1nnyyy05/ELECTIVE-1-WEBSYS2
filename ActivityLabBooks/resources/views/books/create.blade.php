<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Segoe UI', Tahoma, sans-serif; 
        }
        .form-card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        }
        .form-control { 
            background-color: #f1f3f5; 
            border: none; 
            padding: 12px 15px; 
            border-radius: 10px; 
        }
        .form-control:focus { 
            background-color: #e9ecef; 
            box-shadow: none; 
            border: 1px solid #dee2e6; 
        }
        .btn-save { 
            background-color: #212529; 
            color: white; 
            border-radius: 10px; 
            padding: 12px; 
            font-weight: 600; 
            border: none; 
            transition: 0.3s; 
        }
        .btn-save:hover { 
            background-color: #000; 
            color: white; 
            transform: translateY(-2px); 
        }
        .label-custom { 
            font-size: 0.8rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            color: #6c757d; 
            margin-bottom: 5px; 
            margin-left: 5px; 
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <small class="text-muted text-uppercase tracking-wider">New Entry</small>
                <h5 class="fw-bold">Cangco, Ervin Hienz P.</h5>
            </div>

            <div class="card form-card">
                <div class="card-body p-4 p-md-5">
                    <h4 class="mb-4 fw-bold text-dark">Add New Book</h4>
                    
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="label-custom">Book Title</label>
                            <input type="text" class="form-control" name="title" placeholder="e.g. Solo Leveling" required>
                        </div>

                        <div class="mb-3">
                            <label class="label-custom">Author</label>
                            <input type="text" class="form-control" name="author" placeholder="e.g. Chugong" required>
                        </div>

                        <div class="mb-4">
                            <label class="label-custom">Published Year</label>
                            <input type="date" class="form-control" name="published_year" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-save shadow-sm mb-3">Save to Library</button>
                            <a href="{{ route('books.index') }}" class="btn btn-link text-muted text-decoration-none small">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>