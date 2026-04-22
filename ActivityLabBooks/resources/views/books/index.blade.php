<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #fcfcfc; 
            color: #444; 
            font-family: 'Segoe UI', Roboto, sans-serif; 
        }
        .main-card { 
            border: none; 
            border-radius: 15px; 
            overflow: hidden; 
        }
        .table thead { 
            background-color: #f8f9fa; 
            text-transform: uppercase; 
            font-size: 0.75rem; 
            letter-spacing: 1px; 
        }
        .btn-add { 
            background-color: #556b2f; 
            color: white; 
            border-radius: 8px; 
            border: none; 
            transition: 0.3s; 
        }
        .btn-add:hover { 
            background-color: #6b8e23; 
            color: white; 
            transform: translateY(-1px); 
        }
        .btn-action { 
            border-radius: 6px; 
            font-size: 0.85rem; 
            padding: 5px 12px; 
        }
        .alert-custom { 
            border-radius: 10px; 
            border: none; 
            background-color: #d4edda; 
            color: #155724; 
        }

        .table-custom tbody tr:nth-child(even) {
            background-color: #fdfdfd; 
        }

        .table-custom tbody tr:nth-child(odd) {
            background-color: #f7f9f7; 
        }

        .table-custom td {
            padding: 1.2rem 1rem !important;
            border-bottom: 1px solid #f0f0f0;
        }

        .table-custom thead th {
            background-color: #ffffff;
            color: #888;
            border-bottom: 2px solid #556b2f20;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h6 class="text-uppercase ls-wide text-muted mb-1" style="letter-spacing: 2px;">Cangco, Ervin Hienz P.</h6>
        <div style="width: 40px; height: 3px; background: #556b2f; margin: 10px auto;"></div>
    </div>

    <div class="card main-card shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center p-4">
            <h3 class="h5 mb-0 fw-bold">Library Collection</h3>
            <a href="{{ route('books.create') }}" class="btn btn-add px-4 py-2 shadow-sm">+ Add Book</a>
        </div>
        
        <div class="card-body p-0">
            @if(session('success'))
                <div class="mx-4 mb-3 alert alert-custom alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
    <table class="table table-custom table-hover mb-0">
        <thead>
            <tr>
                <th class="ps-4">Title</th>
                <th>Author</th>
                <th>Year</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody class="border-top-0">
            @foreach($books as $book)
            <tr>
                <td class="ps-4 fw-medium text-dark">{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>
                    <span class="badge rounded-pill px-3 py-2 bg-white text-dark border shadow-sm" style="font-weight: 500;">
                        {{ $book->published_year }}
                    </span>
                </td>
                <td class="text-end pe-4">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-secondary btn-action me-1">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-action" onclick="return confirm('Remove this book?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>