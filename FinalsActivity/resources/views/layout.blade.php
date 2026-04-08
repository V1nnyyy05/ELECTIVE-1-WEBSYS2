<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Student Portal</a>
            <div class="navbar-nav ms-auto">
                @if(Session::has('user_id'))
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                    <!-- <a class="nav-link" href="/profile">Profile</a> -->
                    <a class="nav-link" href="/logout">Logout</a>
                @else
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link" href="/register">Register</a>
                @endif
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>