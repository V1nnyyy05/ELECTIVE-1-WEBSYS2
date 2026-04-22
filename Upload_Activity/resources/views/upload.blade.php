<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Image Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .upload-card { border: none; border-radius: 12px; transition: 0.3s; }
        .gallery-item { position: relative; display: inline-block; }
        .gallery-img { 
            object-fit: cover; 
            height: 150px; 
            width: 150px; 
            border-radius: 10px; 
            border: 2px solid #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-delete { 
            position: absolute; 
            top: 5px; 
            right: 5px; 
            padding: 2px 6px; 
            font-size: 10px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h4 class="text-secondary fw-bold">Cangco, Ervin Hienz P.</h4>
        <hr class="w-25 mx-auto">
        <h2 class="mt-3">Media Manager</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card upload-card shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title border-bottom pb-2 mb-3">Single Image Upload</h5>
                    <form action="{{ route('photos.store.single') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small text-muted">Select an image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Upload Single</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card upload-card shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title border-bottom pb-2 mb-3">Multiple Images Upload</h5>
                    <form action="{{ route('photos.store.multiple') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small text-muted">Select multiple images</label>
                            <input type="file" name="images[]" class="form-control" multiple required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Upload Multiple</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h4 class="mt-5 mb-3 text-dark">Uploaded Assets</h4>
<div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
    @foreach ($photos as $photo)
        <div class="col text-center">
            <div class="position-relative d-inline-block">
                <img src="{{ asset('images/' . $photo->image) }}" 
                     class="rounded shadow-sm" 
                     style="height: 120px; width: 120px; object-fit: cover; border: 1px solid #ddd;">

                <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" 
                      style="position: absolute; top: -5px; right: -5px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-danger btn-sm rounded-circle shadow" 
                            onclick="return confirm('Delete this image?')"
                            style="width: 28px; height: 28px; line-height: 1; padding: 0;">
                        &times;
                    </button>
                </form>
            </div>
            <p class="small text-muted mt-2 mb-0 text-truncate" style="max-width: 120px;">
                {{ $photo->image }}
            </p>
        </div>
    @endforeach
</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>