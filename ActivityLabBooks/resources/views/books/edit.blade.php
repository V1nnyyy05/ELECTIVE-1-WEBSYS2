<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f4f6f9; 
            font-family: 'Segoe UI', Tahoma, sans-serif; 
        }
        .edit-card { 
            border-left: 5px solid #495057; 
            border-radius: 15px; 
            border-top: none; 
            border-right: none; 
            border-bottom: none; 
        }
        .form-control { 
            border: 1px solid #e0e0e0; 
            padding: 12px; 
            border-radius: 8px; 
            font-size: 0.95rem; 
        }
        .form-control:focus { 
            border-color: #adb5bd; 
            box-shadow: 0 0 0 0.2rem rgba(0,0,0,0.05); 
        }
        .btn-update { 
            background-color: #495057; 
            color: white; 
            border-radius: 8px; 
            padding: 12px; 
            border: none; 
            font-weight: 600; 
        }
        .btn-update:hover { 
            background-color: #343a40; 
            color: white; 
        }
        .label-style { 
            font-weight: 600; 
            color: #495057; 
            margin-bottom: 8px; 
            display: block; 
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card edit-card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <h4 class="fw-bold m-0">Edit Details</h4>
                        <p class="text-muted small">Update the record for ID: #{{ $book->id }}</p>
                    </div>

                    <form action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="label-style">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $book->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="label-style">Author</label>
                            <input type="text" class="form-control" name="author" value="{{ $book->author }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="label-style">Publish Date</label>
                            <input type="date" class="form-control" name="published_year" value="{{ $book->published_year }}" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-update shadow-sm">Update Book</button>
                            <a href="{{ route('books.index') }}" class="btn btn-light border btn-sm text-muted">Discard Changes</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <p class="text-center mt-4 text-muted small">Cangco, Ervin Hienz P. &copy; 2026</p>
        </div>
    </div>
</div>

</body>
</html>